<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StorageImageTrait;

class Gallery extends Model
{
    use HasFactory;
    use StorageImageTrait;

    protected $table = 'galleries';

    protected $fillable = [
        'tour_id',
        'image'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function getByIdGallery($id)
    {
        return $this->find($id);
    }

    public function saveData($request, $id) 
    {
        $data = [];

        $request->validate([
            'image' => 'required|array',
            'image.*' => 'mimes:jpg,jpeg,png,gif,svg|max:10240'
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->image as $fileItem) {
                $dataImageDetail = $this->storageTraitUploadMutiple($fileItem, 'galleries');

                $data[] = $this->create([
                    'tour_id' => $id,
                    'image' => $dataImageDetail['file_path'],
                ]);
            }
        }

        return $data;
    }

    public function getImageAttribute()
    {
        return asset('storage/galleries/' . $this->getRawOriginal('image'));
    }
}
