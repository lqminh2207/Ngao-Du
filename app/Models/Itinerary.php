<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Itinerary extends AppModel
{
    use HasFactory;

    protected $table = 'itineraries';

    protected $fillable = [
        'tour_id',
        'title'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function getDataAjax($request) 
    {
        $data = $this->latest();

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('title', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)   
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('action.action', [
                    'message' => null,
                    'url_show' => null,
                    'url_edit' => route('itineraries.edit', $data->id),
                    'url_destroy' => route('itineraries.destroy', $data->id),
                ]);
            })

            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function saveData($request)
    {
        $input = $request->only('type_id', 'title');
        $input['tour_id'] =  !empty($id) ? Ultilities::clearXSS($id) : '';
        $input['title'] =  !empty($id) ? Ultilities::clearXSS($id) : '';
        $data = $this->create($input);

        return $data;
    }

    public function updateData($request, $id)
    {
        $itinerary = $this->find($id);
        $input = $request->only('type_id', 'title');
        $input['tour_id'] =  !empty($id) ? Ultilities::clearXSS($id) : '';
        $input['title'] =  !empty($id) ? Ultilities::clearXSS($id) : '';
        $data = $itinerary->update($input);

        return $data;
    }
}
