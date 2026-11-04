<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Receives photos from the Uppy uploader on the property and FRE forms.
 * Only real images are accepted; anything else is rejected before it
 * reaches the public disk.
 */
class ImageUploadController extends Controller
{
    public const IMAGE_RULES = ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];

    public function uploadPropertyImage(Request $request, $folderName)
    {
        return $this->storeUploads($request, 'properties');
    }

    public function uploadFREImage(Request $request, $folderName)
    {
        return $this->storeUploads($request, 'fres');
    }

    private function storeUploads(Request $request, $directory)
    {
        // Uppy re-sends images that are already attached when editing;
        // those carry an uploadName and need no new file.
        if ($request->has('uploadName')) {
            return response()->json([]);
        }

        $request->validate([
            'files' => ['required', 'array', 'min:1', 'max:20'],
            'files.*' => self::IMAGE_RULES,
        ]);

        $imageURL = [];
        foreach ($request->file('files') as $image) {
            $imageURL['uploadURL'] = $image->store($directory);
        }

        return response()->json($imageURL);
    }
}
