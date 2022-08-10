<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItineraryRequest;
use App\Models\Itinerary;
use App\Models\Tour;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    protected $itinerary;
    
    public function __construct(Itinerary $itinerary, Tour $tour)
    {
        $this->itinerary = $itinerary;
        $this->tour = $tour;
    }

    public function show($tour_id)
    {
        return view('admin.itineraries.index', compact('tour_id'));
    }

    public function create()
    {
        
    }

    public function store(ItineraryRequest $request)
    {
        
    }

    public function getData(Request $request) {
        if ($request->ajax()) 
        {
            return $this->itinerary->getDataAjax($request);
        }
    }

    public function edit($id)
    {
        
    }

    public function update(ItineraryRequest $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
