<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $gallery;
    protected $tour;

    public function __construct(Tour $tour, Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->tour = $tour;
    }

    public function show($tour_id)
    {
        $tour = $this->tour->getByIdTour($tour_id);

        return view('admin.galleries.index', compact('tour', 'tour_id'));
    }

    public function store(GalleryRequest $request, $tour_id)
    {
        try {
            return $this->gallery->saveData($request, $tour_id);
        } catch (Exception $e) {
            // dd($e);
        }
    }


    public function destroy(Request $request)
    {
        $gallery = $this->gallery->findOrFail($request->id);

        return $gallery->delete();
    }
}
