<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Itinerary;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected $tour;
    protected $itinerary;
    protected $place;

    public function __construct(Tour $tour, Itinerary $itinerary, Place $place)
    {
        $this->tour = $tour;
        $this->itinerary = $itinerary;
        $this->place = $place;
    }

    public function getAllData()
    {
        $data = $this->place->getAll();

        return response()->json([
            'data' => PlaceResource::collection($data),
            'message' => 'Places retrieved successfully.',
        ]);
    }

    public function getData(Request $request, $tour_id, $itinerary_id)
    {
        $tourId = $this->itinerary->where('id', $itinerary_id)->get()[0]->tour_id;
        
        if($tourId == $tour_id) 
        {
            $data = $this->place->getByItineraryId($tour_id, $itinerary_id);
        }

        return response()->json([
            'data' => PlaceResource::collection($data),
            'message' => 'Places retrieved successfully.',
        ]);
    }

    public function showInfo(Request $request, $tour_id, $itinerary_id, $id)
    {
        $tourId = $this->itinerary->where('id', $itinerary_id)->get()[0]->tour_id;
        
        if($tourId == $tour_id) 
        {
            $place = $this->place->where('itinerary_id', $itinerary_id)->find($id);
        }

        return response()->json([
            'data' => new PlaceResource($place),
            'message' => 'Place retrieved successfully.',
        ]);
    }

    public function store(PlaceRequest $request, $tour_id, $itinerary_id)
    {
        $tourId = $this->itinerary->where('id', $itinerary_id)->get()[0]->tour_id;
        
        if($tourId == $tour_id) 
        {
            $data = $this->place->saveData($request);
        }

        return response()->json([
            'data' => new PlaceResource($data),
            'message' => 'Place created successfully.',

        ]);
    }

    public function update(PlaceRequest $request, $tour_id, $itinerary_id, $id)
    {
        $tourId = $this->itinerary->where('id', $itinerary_id)->get()[0]->tour_id;

        if($tourId == $tour_id) 
        {
            $data = $this->place->updateData($request, $tour_id, $itinerary_id, $id);
        }
        
        return response()->json([
            'data' => new PlaceResource($data),
            'message' => 'Place updated successfully.',
        ]);
    }

    public function destroy($tour_id, $itinerary_id, $id)
    {
        $tourId = $this->itinerary->where('id', $itinerary_id)->get()[0]->tour_id;
        
        if($tourId == $tour_id) 
        {
            $place = $this->place->where('itinerary_id', $itinerary_id)->findOrFail($id);
        }

        $place->delete();

        return response()->json([
            'message' => 'Place deleted successfully.',
        ]);
    }
}
