<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public static function store($request, $data, $directory, $access = 'public'): void
    {
        Storage::disk('local')->makeDirectory("$access/$directory");

        $name = Str::random(10) . str_replace(" ", "", $request->getClientOriginalName());
        $name = pathinfo($name, PATHINFO_FILENAME) . '.webp';

        $path = storage_path("app/$access/$directory/$name");
        $pathRelative = "$directory/$name";

        $manager = new ImageManager(new Driver());

        $manager->read($request)
            ->scaleDown(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->toWebp(100)->save($path);

        if ($data->images()->where('default', '=', '1')->count() == 0) {
            $data->images()->create([
                'url'     => $pathRelative,
                'default' => '1'
            ]);
        } else {
            Storage::disk('local')->delete("$access/" . $data->images()->select('url')->where('default', '=', '1')->first()->url);

            $data->images()->update([
                'url'     => $pathRelative,
                'default' => '1'
            ]);
        }
    }

    public static function multipleStore(object $model, array $modelImages, string $directory, string $additionalPath = '', string $access = 'public'): void
    {
        foreach ($modelImages as $key => $image) {
            $name = Str::random(10) . str_replace(" ", "", $image->getClientOriginalName());
            $name = pathinfo($name, PATHINFO_FILENAME) . '.webp';

            $directory = $directory . $additionalPath;

            Storage::disk('local')->makeDirectory("$access/$directory/$key");

            $path = storage_path("app/$access/$directory/$key/$name");
            $pathRelative = "$directory/$key/$name";

            $manager = new ImageManager(new Driver());

            $manager->read($image)
                ->scaleDown(1280, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
            ->toWebp(100)->save($path);

            if ($model->images()->select()->where('url', 'like', "%$key%")->first()?->count() == 0) {
                $model->images()->create([
                    'url' => $pathRelative,
                ]);
            } else {
                Storage::disk('local')->delete("$access/" . $model->images()->select()->where('url', 'like', "%$key%")->first()->url);

                $model->images()->select()->where('url', 'like', "%$key%")->first()->update([
                    'url' => $pathRelative,
                ]);
            }
        }
    }

    public static function ckeditorStore($model, $modelImages, $directory, $additionalPath = ''): void
    {
        $reExtractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($reExtractImages, $modelImages, $matches);

        $images = $matches[1];
        $directory = $directory . $additionalPath;

        foreach ($images as $image) {
            $imageUrl = "$directory/" . pathinfo($image, PATHINFO_BASENAME);

            $model->images()->create([
                'url' => $imageUrl
            ]);
        }
    }

    public static function ckeditorUpdate($model, $modelImages, $directory, $additionalPath = '', $access = 'public'): void
    {
        $reExtractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($reExtractImages, $modelImages, $matches);

        $newImages = $matches[1];
        $directory = $directory . $additionalPath;

        $oldImages = $model->images()->select('url')
            ->where('default', 0)
            ->where('url', 'like', '%' . $directory . '%')
            ->pluck('url')
            ->toArray();

        foreach ($newImages as $newImage) {
            $imageUrl = "$directory/" . pathinfo($newImage, PATHINFO_BASENAME);

            $key = array_search($imageUrl, $oldImages);

            if ($key === false) {
                $model->images()->create([
                    'url' => $imageUrl
                ]);
            } else {
                unset($oldImages[$key]);
            }
        }

        foreach ($oldImages as $oldImage) {
            Storage::disk('local')->delete("$access/" . $oldImage);
            $model->images()->where('url', $oldImage)->delete();
        }
    }

    public static function ckeditorMoveToStorage($request, $directory, $access = 'public'): array
    {
        Storage::disk('local')->makeDirectory("$access/$directory");

        $name = Str::random(10) . str_replace(" ", "", $request->getClientOriginalName());
        $name = pathinfo($name, PATHINFO_FILENAME) . '.webp';

        $path = storage_path("app/$access/$directory/$name");
        $pathRelative = "$directory/$name";

        $manager = new ImageManager(new Driver());

        $manager->read($request)
            ->scaleDown(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->toWebp(100)->save($path);

        return [
            "resourceType" => "Files",
            'url' => Storage::url($pathRelative),
            "fileName" => $name,
            "uploaded" => 1
        ];
    }

    public function show($image)
    {
        $path = storage_path("app/admin/images/{$image}");

        return response()->file($path);
    }

    public static function destroy($data, $access = 'public'): void
    {
        $images = $data->images()->select('id', 'url')->get();

        foreach ($images as $image) {
            Image::destroy($image->id);
            Storage::disk('local')->delete("$access/" . $image->url);
        }
    }
}
