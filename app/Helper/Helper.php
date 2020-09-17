<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function uploadImagesToStorage($image, $directory, $removeOldImage = false, $oldImage = null)
    {
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $image->extension();
        $filenameFinal = $filename . '-' . time() . '.' . $extension;
        $image->storeAs('public/' . $directory, $filenameFinal);
        if ($removeOldImage === true && $oldImage !== null) {
            Storage::delete('public/' . $directory . '/' . $oldImage);
        }
        return $filenameFinal;
    }
}
