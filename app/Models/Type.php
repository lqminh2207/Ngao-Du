<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Type extends AppModel
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'title', 'status'
    ];

    public function getDataAjax($request) 
    {
        $search = $request->search;
        $query = $this->latest();

        if(!empty($request->status)) {
            $data = $query->whereStatus($request->status);
        }

        if(!empty($search)) {
            $query->where(function ($sub) use ($search) {
                $sub->where('title', 'like', '%' . $search . '%');
            });
        }

        return Datatables::of($query)   
            ->addIndexColumn()
            ->editColumn('status', function($data) {
                return view('action.switch', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->addColumn('action', function($item) {
                return view('action.action', [
                    'id' => $item->id,
                    'url_show' => null,
                    // 'data_old_info' => $item,
                    // 'url_edit' => route('types.edit', $item->id),
                    'url_edit' => null,
                    'url_edit_modal' => route('types.edit', $item->id),
                    'url_destroy' => route('types.destroy', $item->id),
                ]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function saveData($request) {
        $input = $request->only(['title', 'status']);
        $input['title'] = Ultilities::clearXSS($input['title']);
        $data = $this->create($input);

        return $data;
    }

    public function updateData($request, $id) {
        $type = $this->find($id);
        $input = $request->only('title', 'status');
        $input['title'] = Ultilities::clearXSS($input['title']);
        $data = $type->update($input);

        return $data;
    }
}
