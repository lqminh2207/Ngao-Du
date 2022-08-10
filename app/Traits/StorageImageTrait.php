<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName(); // ten file goc
            $name_image = current(explode('.', $fileNameOrigin));
            $fileNameHash = $name_image . time() . '.' . $file->getClientOriginalExtension();  // fileNameHash nay de luu vao database
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/', $fileNameHash);
            // data tra ve
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => $fileNameHash
            ];

            return $dataUploadTrait;
        }
        
        return null;
    }
    public function storageTraitUploadMutiple($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName(); // ten file goc
        $name_image = current(explode('.', $fileNameOrigin));
        $fileNameHash = $name_image . rand(0, 99) . time() . '.' . $file->getClientOriginalExtension();  // fileNameHash nay de luu vao database
        $filePath = $file->storeAs('public/' . $folderName . '/', $fileNameHash);

        // data tra ve
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => $fileNameHash
        ];
        
        return $dataUploadTrait;
    }
}
