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

    public function getAll()
    {
        return $this->all();
    }

    public function getByTourId($tour_id)
    {
        return $this->where('tour_id', $tour_id)->get();
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function getDataAjax($request) 
    {
        $data = $this->latest();

        if (!empty($request->tour_id)) {
            $data = $data->whereTourId($request->tour_id);
        }

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
                    'model' => $data,
                    'id' => $data->id,
                    'url_show' => route('places.show', [$data->tour_id, $data->id]),
                    'edit_modal' => route('itineraries.edit', [$data->tour_id, $data->id]),
                    'url_destroy' => route('itineraries.destroy', $data->id),
                ]);
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function saveData($request)
    {
        $input = $request->only('tour_id', 'title');
        $input['tour_id'] =  !empty($request->tour_id) ? Ultilities::clearXSS($request->tour_id) : '';
        $input['title'] =  !empty($request->title) ? Ultilities::clearXSS($request->title) : '';
        $data = $this->create($input);

        return $data;
    }

    public function updateData($request, $tour_id, $id)
    {
        $itinerary = $this->find($id);
        $input['title'] =  !empty($request->title) ? Ultilities::clearXSS($request->title) : '';
        $data = $itinerary->update($input);   
        // dd($itinerary);

        return $itinerary;
    }
}
