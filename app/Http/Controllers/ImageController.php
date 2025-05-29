<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Process and optimize an uploaded image
     *
     * @param Request $request
     * @param string $field
     * @param string $directory
     * @param int $width
     * @param int $height
     * @return string|null
     */
    public function processImage(Request $request, string $field = 'image', string $directory = 'event-images', int $width = 1200, int $height = null): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $image = $request->file($field);
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Create image instance
        $img = Image::make($image->getRealPath());
        
        // Resize the image while maintaining aspect ratio
        if ($height) {
            $img->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        
        // Optimize the image
        $img->encode($image->getClientOriginalExtension(), 80);
        
        // Save the image
        $path = $directory . '/' . $filename;
        Storage::disk('public')->put($path, $img->stream());
        
        return $path;
    }
    
    /**
     * Generate multiple sizes of an image for responsive display
     *
     * @param Request $request
     * @param string $field
     * @param string $directory
     * @return array|null
     */
    public function processResponsiveImage(Request $request, string $field = 'image', string $directory = 'event-images'): ?array
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $image = $request->file($field);
        $filename = time() . '_' . uniqid();
        $extension = $image->getClientOriginalExtension();
        
        // Define sizes
        $sizes = [
            'large' => 1200,
            'medium' => 800,
            'small' => 400,
            'thumbnail' => 200
        ];
        
        $paths = [];
        
        foreach ($sizes as $size => $width) {
            $img = Image::make($image->getRealPath());
            
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $img->encode($extension, 80);
            
            $sizePath = $directory . '/' . $filename . '_' . $size . '.' . $extension;
            Storage::disk('public')->put($sizePath, $img->stream());
            
            $paths[$size] = $sizePath;
        }
        
        return $paths;
    }
}
