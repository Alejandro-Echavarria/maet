<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public static function store($request, $job)
    {
        Storage::makeDirectory('images/jobs');

        $name = Str::random(10) . $request->getClientOriginalName();
        $path = storage_path('app/public/images/jobs/' . $name);
        $pathRelative = 'images/jobs/' . $name;

        $manager = new ImageManager(new Driver());

        $manager->read($request)
            ->resizeDown(1200, 800, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path);

        if ($job->images()->where('default', '=', '1')->count() == 0) {
            $job->images()->create([
                'url'     => $pathRelative,
                'default' => '1'
            ]);
        } else {
            Storage::delete($job->images()->select('url')->where('default', '=', '1')->first()->url);

            $job->images()->update([
                'url'     => $pathRelative,
                'default' => '1'
            ]);
        }

    }
}
