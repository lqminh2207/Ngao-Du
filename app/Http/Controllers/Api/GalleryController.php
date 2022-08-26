<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Resources\GalleryResource;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Tour;
use Exception;

class GalleryController extends Controller
{
    protected $tour;
    protected $gallery;

    public function __construct(Tour $tour, Gallery $gallery)
    {
        $this->tour = $tour;
        $this->gallery = $gallery;
    }

    public function store(GalleryRequest $request, $tour_id)
    {
        try {
            $data = $this->gallery->saveData($request, $tour_id);

            return response()->json([
                'data' => GalleryResource::collection($data),
                'message' => "Image successfuly updated"
            ]);
        } catch (Exception $e) {
            // dd($e);
            return response()->json([
                'message' => "Uploaded image fail."
            ], 500);
        }
    }


    public function destroy(Request $request, $tour_id, $id)
    {
        $gallery = $this->gallery->where('tour_id', $tour_id)->findOrFail($id);

        $gallery->delete();

        return response()->json([
            'message' => "Image successfuly deleted"
        ]);
    }
}
