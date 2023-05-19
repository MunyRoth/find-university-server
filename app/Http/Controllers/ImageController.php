<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function show($name): Response
    {
        $path = storage_path('app/images/' . $name);

        if (!File::exists($path)) {
            return Response([
                'status' => $path,
            ], 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return Response($file, 200)->header("Content-Type", $type);
    }
}
