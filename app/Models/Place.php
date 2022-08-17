<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $fillable = [
        'itinerary_id',
        'title',
        'content'
    ];

    public function itinerary() 
    {
        return $this->belongsTo(Itinerary::class, 'itinerary_id', 'id');
    }

    public function getDataAjax($request)
    {
        $data = $this->latest();

        if (!empty($request->itineraries_id)) {
            $data = $data->whereItineraryId($request->itineraries_id);
        }

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%'. $search . '%');
            });
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('action.action', [
                    'model' => $data,
                    'id' => $data->id,
                    'edit_modal' => route('places.edit', [$data->itinerary->tour_id, $data->itinerary_id, $data->id]),
                    'url_destroy' => route('places.destroy', [$data->itinerary_id, $data->id]),
                ]);
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function saveData($request) 
    {
        $input = $request->only('itinerary_id', 'title', 'content');
        $input['itinerary_id'] = !empty($request->itinerary_id) ? Ultilities::clearXSS($request->itinerary_id) : '';
        $input['title'] = !empty($request->title) ? Ultilities::clearXSS($request->title) : '';
        $input['content'] = !empty($request->content) ? $request->content : '';
        $data = $this->create($input);

        return $data;
    }

    public function updateData($request, $id) 
    {
        $place = $this->find($request->id);
        $input['title'] = !empty($request->title) ? Ultilities::clearXSS($request->title) : '';
        $input['content'] = !empty($request->content) ? $request->content : '';
        $data = $place->update($input);

        return $data;
    }
}
