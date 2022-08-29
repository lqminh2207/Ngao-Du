<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\Tour;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $tour;
    protected $review;

    public function __construct(Tour $tour, Review $review)
    {
        $this->tour = $tour;
        $this->review = $review;
    }

    public function getAllData()
    {
        $data = $this->review->getAll();

        return response()->json([
            'data' => ReviewResource::collection($data),
            'message' => 'Review retrieved successfully.'
        ]);
    }

    public function getData(Request $request, $tour_id)
    {
        $data = $this->review->getByTourId($tour_id);

        return response()->json([
            'data' => ReviewResource::collection($data),
            'message' => 'Review retrieved successfully.'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->review->rules());
        $data = $this->review->saveData($request);

        return response()->json([
            'data' => new ReviewResource($data),
            'message' => 'Review created successfully.'
        ]);
    }

    public function destroy($tour_id, $id)
    {
        $review = $this->review->where('tour_id', $tour_id)->findOrFail($id);

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully.'
        ]);
    }
}
