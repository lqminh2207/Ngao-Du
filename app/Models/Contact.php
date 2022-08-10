<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Contact extends AppModel
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'status',
    ];

    public function rules() 
    {
        return [
            'name' => 'required|string|max:100',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|string|max:150',
            'message' => 'required|string|max:500',
        ];
    }

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
                $result->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)   
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                return view('action.seen', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->addColumn('action', function($data) {
                return view('action.action', [
                    'id' => $data->id,
                    'message' => $data->message,
                    'url_show' => null,
                    'url_edit' => null,
                    'url_destroy' => route('contacts.destroy', $data->id),
                ]);
            })
            ->editColumn('created_at', function($data) {
                return  $data->created_at->format('d/m/Y H:i:s'); 
             })
             ->editColumn('updated_at', function($data) {
                return  $data->created_at->format('d/m/Y H:i:s'); 
             })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function saveData($request) {
        $input = $request->only('name', 'phone', 'email', 'message', 'status');
        $input['title'] = Ultilities::clearXSS($input['name']);
        $input['phone'] = Ultilities::clearXSS($input['phone']);
        $input['email'] = Ultilities::clearXSS($input['email']);
        $input['message'] = Ultilities::clearXSS($input['message']);
        $data = $this->create($input);

        return $data;
    }
}
