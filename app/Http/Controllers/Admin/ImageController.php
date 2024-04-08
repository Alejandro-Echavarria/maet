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
    public static function store($request, $data, $directory, $access = 'public')
    {
        Storage::disk('local')->makeDirectory("$access/$directory");

        $name = Str::random(10) . $request->getClientOriginalName();
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

    public static function ckeditorStore($request, $data, $directory, $access = 'public')
    {
        Storage::disk('local')->makeDirectory("$access/$directory");

        $name = Str::random(10) . $request->getClientOriginalName();
        $name = pathinfo($name, PATHINFO_FILENAME) . '.webp';

        $path = storage_path("app/$access/$directory/$name");
        $pathRelative = "$directory/$name";

        $manager = new ImageManager(new Driver());

        $manager->read($request)
            ->scaleDown(1280, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->toWebp(100)->save($path);

        $data->images()->create([
            'url'     => $pathRelative
        ]);

        return [
            "resourceType" => "Files",
            'url' => Storage::url($pathRelative),
            "fileName" => $name,
            "uploaded" => 1
        ];
    }

    public function show($image)
    {
        $path = storage_path("app/admin/images/clients/{$image}");

        return response()->file($path);
    }

    public static function destroy($data, $access = 'public')
    {
        $images = $data->images()->select('id', 'url')->get();

        foreach ($images as $image) {
            Image::destroy($image->id);
            Storage::disk('local')->delete("$access/" . $image->url);
        }
    }
}
