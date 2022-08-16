<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItineraryRequest;
use App\Models\Itinerary;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    protected $itinerary;
    protected $tour;
    
    public function __construct(Itinerary $itinerary, Tour $tour)
    {
        $this->itinerary = $itinerary;
        $this->tour = $tour;
    }

    public function show($tour_id)
    {
        return view('admin.itineraries.index', compact('tour_id'));
    }

    public function showInfo(Request $request, $id) 
    {
        $itinerary = $this->itinerary->find($id);

        return response()->json([
            'itinerary' => $itinerary
        ]);
    }

    public function store(ItineraryRequest $request, $tour_id)
    {
        try {
            $this->itinerary->saveData($request, $tour_id);
        
            return response()->json([
                'message' => 'Itinerary successfully created'
            ]);
        } catch (Exception $exception) {
            // dd($exception);
        }
    }

    public function getData(Request $request) {
        if ($request->ajax()) 
        {
            return $this->itinerary->getDataAjax($request);
        }
    }

    public function update(ItineraryRequest $request, $id)
    {
        try{
            $this->itinerary->updateData($request, $id);

            return response()->json([
                'message' => 'Itinerary successfully updated'
            ]);
        } catch(Exception $exception) {
            // dd($exception);
        }
    }

    public function destroy($id)
    {
        $data = $this->itinerary->find($id);

        if(empty($data)) {
            \abort(404);
        }

        $data->delete();

        return response()->json([
           'message' => 'Itinerary successfuly deleted' 
        ]);
    }
}
