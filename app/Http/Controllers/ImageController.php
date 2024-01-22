<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store($request, $job)
    {
        $url = Storage::put('jobs', $request);

        $job->image()->create([
            'url' => $url
        ]);
    }
}
