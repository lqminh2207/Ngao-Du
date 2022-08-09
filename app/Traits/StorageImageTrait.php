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

    // public function UserImageUpload($query) // Taking input image as parameter
    // {
    //     $image_name = rand(20, 99);
    //     $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
    //     $image_full_name = $image_name.'.'.$ext;
    //     $upload_path = 'image/';    //Creating Sub directory in Public folder to put image
    //     $image_url = $upload_path.$image_full_name;
    //     $success = $query->move($upload_path,$image_full_name);
 
    //     return $image_url; // Just return image
    // }
}
