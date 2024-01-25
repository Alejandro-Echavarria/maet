<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public static function store($request, $data, $directory)
    {
        Storage::makeDirectory($directory);

        $name = Str::random(10) . $request->getClientOriginalName();
        $path = storage_path("app/public/$directory/$name");
        $pathRelative = "$directory/$name";

        $manager = new ImageManager(new Driver());

        $manager->read($request)
            ->resizeDown(1200, 800, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path);

        if ($data->images()->where('default', '=', '1')->count() == 0) {
            $data->images()->create([
                'url'     => $pathRelative,
                'default' => '1'
            ]);
        } else {
            Storage::delete($data->images()->select('url')->where('default', '=', '1')->first()->url);

            $data->images()->update([
                'url'     => $pathRelative,
                'default' => '1'
            ]);
        }
    }

    public static function ckeditorStore($request, $data, $directory)
    {
        /* Creating a directory called posts in the storage folder. */
        Storage::makeDirectory($directory);

        $name = Str::random(10) . $request->getClientOriginalName();
        $path = storage_path("app/public/$directory/$name");
        $pathRelative = "$directory/$name";

        $manager = new ImageManager(new Driver());

        $manager->read($request)
            ->resizeDown(1200, 800, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path);

        $data = Job::find($data)->first();

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

    public static function destroy($data)
    {
        $images = $data->images()->select('id', 'url')->get();

        foreach ($images as $image) {
            Image::destroy($image->id);
            Storage::delete($image->url);
        }
    }
}
