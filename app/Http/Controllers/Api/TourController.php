<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $tour;

    public function __construct(Tour $tour)
    {
        $this->tour = $tour;
    }

    public function getData()
    {
        $data = $this->tour->getAll();

        return response()->json([
            'data' => TourResource::collection($data),
            'message' => 'Tour retrieved successfully.'
        ]);
    }

    public function store(TourRequest $request)
    {
        $data = $this->tour->saveData($request);

        return response()->json([
            'data' => new TourResource($data),
            'message' => 'Tour created successfully.'
        ]);
    }

    public function update(TourRequest $request, $id)
    {
        $data = $this->tour->updateData($request, $id);

        return response()->json([
            'data' => new TourResource($data),
            'message' => 'Tour updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $tour = $this->tour->findOrFail($id);

        $tour->delete();

        return response()->json([
            'message' => 'Tour deleted successfully.'
        ]);
    }
}
