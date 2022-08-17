<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Itinerary;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected $place;
    protected $itinerary;

    public function __construct(Itinerary $itinerary, Place $place)
    {
        $this->place = $place;
        $this->itinerary = $itinerary;
    }

    public function show($tour_id, $itinerary_id)
    {
        return view('admin.places.index', compact('tour_id', 'itinerary_id'));
    }

    public function showInfo(Request $request)
    {
        $place = $this->place->find($request->id);

        return response()->json([
            'place' => $place
        ]);
    }

    public function getData(Request $request) 
    {
        if ($request->ajax())
        {
            return $this->place->getDataAjax($request);
        }
    }

    public function store(PlaceRequest $request, $itinerary_id)
    {
        $this->place->saveData($request, $itinerary_id);

        return response()->json([
            'message' => 'Place successfully created'
        ]);
    }

    public function update(PlaceRequest $request, $id)
    {
        $this->place->updateData($request, $id);

        return response()->json([
            'message' => 'Place successfully updated'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $place = $this->place->findOrFail($request->id);

        if(empty($place)) {
            \abort(404);
        }

        $place->delete();

        return response()->json([
            'message' => 'Place successfully deleted'
        ]);
    }
}
