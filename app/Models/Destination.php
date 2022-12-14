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

    public function tours() 
    {
        return $this->hasMany(Tour::class);
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getDataAjax($request) 
    {
        $data = $this->query();

        if(!empty($request->status)) {
            $data = $data->whereStatus($request->status);
        }   

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('title', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)   
            ->addIndexColumn()
            ->editColumn('image', function ($data){
                return '<img src="'.$data->img_url.'" alt="" width="120" height="120">';
            })
            ->editColumn('status', function ($data) {
                return view('action.switch', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->addColumn('action', function ($data) {
                return view('action.action', [
                    'id' => $data->id,
                    // 'url_show' => null,
                    'url_edit' => null,
                    'edit_modal' => route('destinations.edit', $data->id),
                    'url_destroy' => route('destinations.destroy', $data->id),
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
        $input = $request->only(['title', 'slug', 'status']);
        $input['title'] = Ultilities::clearXSS($input['title']);
        $input['slug'] = Ultilities::clearXSS($input['slug']);
        $dataUploadImage = $this->storageTraitUpload($request, 'image', 'destinations');
        if(!empty($dataUploadImage)) {
            $input['image'] = $dataUploadImage['file_path'];
        }
        $data = $destination->update($input);

        return $this->find($id);
    }

    public function getImgUrlAttribute() 
    {
        return asset('storage/destinations/' . $this->getRawOriginal('image'));
    }

    // client

    public function getDestinationHomepage()
    {
        return $this->whereStatus(self::ACTIVE)->latest()->take(8)->withCount('tours')->get();
    }
}
