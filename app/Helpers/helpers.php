<?php

use Intervention\Image\Facades\Image;

if (!function_exists('uploadFile')) {
    function uploadFile($file, $folder, $prefix)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = time() . '_' . $prefix . '.' . $extension;
        $destination = public_path("upload/{$folder}");

        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }

        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            Image::make($file->getRealPath())->save("{$destination}/{$filename}");
        } else {
            $file->move($destination, $filename);
        }

        return $filename;
    }
}
