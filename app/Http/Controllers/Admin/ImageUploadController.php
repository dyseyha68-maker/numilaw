<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        Log::info('Image upload request received');
        Log::info('Has file: '.($request->hasFile('image') ? 'yes' : 'no'));

        if (! $request->hasFile('image')) {
            Log::error('No image file in request');

            return response()->json(['error' => 'No image provided'], 400);
        }

        $image = $request->file('image');

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images/summernote');

        Log::info('Destination path: '.$destinationPath);

        if (! is_dir($destinationPath)) {
            $created = mkdir($destinationPath, 0755, true);
            Log::info('Directory created: '.($created ? 'yes' : 'no'));
        }

        try {
            $image->move($destinationPath, $filename);
            Log::info('File moved successfully: '.$filename);

            $url = url('/laravel-img/summernote/'.$filename);
            Log::info('URL: '.$url);

            return response()->json([
                'url' => $url,
                'filename' => $filename,
            ]);
        } catch (\Exception $e) {
            Log::error('Upload failed: '.$e->getMessage());

            return response()->json(['error' => 'Upload failed: '.$e->getMessage()], 500);
        }
    }
}
