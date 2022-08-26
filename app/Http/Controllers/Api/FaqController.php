<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Models\Tour;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faq;
    protected $tour;

    public function __construct(Tour $tour, Faq $faq)
    {
        $this->tour = $tour;
        $this->faq = $faq;
    }

    public function getAllData()
    {
        $data = $this->faq->getAll();

        return response()->json([
            'data' => FaqResource::collection($data),
            'message' => 'Faq retrieved successfully.'
        ]);
    }

    public function getData(Request $request, $tour_id)
    {
        $data = $this->faq->getByTourId($tour_id);

        return response()->json([
            'data' => FaqResource::collection($data),
            'message' => 'Faq retrieved successfully.'
        ]);
    }

    public function showInfo(Request $request, $id)
    {
        $faq = $this->faq->where('tour_id', $request->tour_id)->find($request->id);
        
        return response()->json([
            'data' => new FaqResource($faq),
            'message' => 'Faq retrieved successfully.'
        ]);
    }

    public function store(FaqRequest $request)
    {
        $data = $this->faq->saveData($request);

        return response()->json([
            'data' => new FaqResource($data),
            'message' => 'Faq created successfully.'
        ]);
    }

    public function update(FaqRequest $request, $tour_id, $id)
    {
        $data = $this->faq->updateData($request, $tour_id, $id);
        
        return response()->json([
            'data' => new FaqResource($data),
            'message' => 'Faq updated successfully.'
        ]);
    }

    public function destroy($tour_id, $id)
    {
        $faq = $this->faq->where('tour_id', $tour_id)->findOrFail($id);

        $faq->delete();

        return response()->json([
            'message' => 'Faq deleted successfully.'
        ]);
    }
}
