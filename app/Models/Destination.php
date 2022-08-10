<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\StorageImageTrait;

class Destination extends AppModel
{
    use HasFactory;
    use StorageImageTrait;

    protected $table = 'destinations';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'status'
    ];

    public function getDataAjax($request) 
    {
        $search = $request->search;
        $data = $this->latest();

        if(!empty($request->status)) {
            $data = $data->whereStatus($request->status);
        }   

        if(!empty($search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('title', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)   
            ->addIndexColumn()
            ->addColumn('image', function ($data){
                return '<img src="'.$data->img.'" alt="" width="120" height="120">';
            })
            ->editColumn('status', function($data) {
                return view('action.switch', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->addColumn('action', function($item) {
                return view('action.action', [
                    'message' => null,
                    'url_show' => null,
                    'url_edit' => route('destinations.edit', $item->id),
                    'url_destroy' => route('destinations.destroy', $item->id),
                ]);
            })
            ->rawColumns(['action', 'image', 'status'])
            ->make(true);
    }

    public function saveData($request) {
        $input = $request->only(['title', 'slug', 'image', 'status']);
        $input['title'] = Ultilities::clearXSS($input['title']);
        $input['slug'] = Ultilities::clearXSS($input['slug']);
        $dataUploadImage = $this->storageTraitUpload($request, 'image', 'destinations');
        if(!empty($dataUploadImage)) {
            $input['image'] = $dataUploadImage['file_path'];
        }
        $data = $this->create($input);

        return $data;
    }

    public function updateData($request, $id) {
        $destination = $this->find($id);
        $input = $request->only(['title', 'slug', 'image', 'status']);
        $input['title'] = Ultilities::clearXSS($input['title']);
        $input['slug'] = Ultilities::clearXSS($input['slug']);
        $dataUploadImage = $this->storageTraitUpload($request, 'image', 'destinations');
        if(!empty($dataUploadImage)) {
            $input['image'] = $dataUploadImage['file_path'];
        }
        $data = $destination->update($input);

        return $data;
    }

    public function getImgAttribute() 
    {
        return asset('storage/destinations/' . $this->getRawOriginal('image'));
    }
}
