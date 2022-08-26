<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItineraryRequest;
use App\Http\Resources\ItineraryResource;
use App\Models\Tour;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    protected $itinerary;
    protected $tour;

    public function __construct(Tour $tour, Itinerary $itinerary)
    {
        $this->tour = $tour;
        $this->itinerary = $itinerary;
    }

    public function getAllData()
    {
        $data = $this->itinerary->getAll();

        return response()->json([
            'data' => ItineraryResource::collection($data),
            'message' => 'Itineraries retrieved successfully.'
        ]);
    }

    public function getData(Request $request, $tour_id)
    {
        $data = $this->itinerary->getByTourId($tour_id);

        return response()->json([
            'data' => ItineraryResource::collection($data),
            'message' => 'Itineraries retrieved successfully.'
        ]);
    }

    public function showInfo(Request $request)
    {
        $itinerary = $this->itinerary->where('tour_id', $request->tour_id)->find($request->id);
        
        return response()->json([
            'data' => new ItineraryResource($itinerary),
            'message' => 'Itinerary retrieved successfully.'
        ]);
    }

    public function store(ItineraryRequest $request)
    {
        $data = $this->itinerary->saveData($request);

        return response()->json([
            'data' => new ItineraryResource($data),
            'message' => 'Itinerary created successfully.'
        ]);
    }

    public function update(ItineraryRequest $request, $tour_id, $id)
    {
        $data = $this->itinerary->updateData($request, $tour_id, $id);
        
        return response()->json([
            'data' => new ItineraryResource($data),
            'message' => 'Itinerary updated successfully.'
        ]);
    }

    public function destroy($tour_id, $id)
    {
        $itinerary = $this->itinerary->findOrFail($id);

        $itinerary->delete();

        return response()->json([
            'message' => 'Itinerary deleted successfully.'
        ]);
    }
}
