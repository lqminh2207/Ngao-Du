<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    protected $review;
    protected $tour;

    public function __construct(Tour $tour, Review $review)
    {
        $this->tour = $tour;
        $this->review = $review;
    }

    public function show($tour_id)
    {
        return view('admin.reviews.index', compact('tour_id'));
    }

    public function store(Request $request)
    {
        $request->validate($this->review->rules());
        $this->review->saveData($request);

        return redirect()->back()->withInput()->with('message', 'Your review has been successfuly sent');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) 
        {
            return $this->review->getDataAjax($request);
        }
    }
    
    public function destroy(Request $request, $id)
    {
        $review = $this->review->find($id);

        if(empty($review)) {
            \abort(404);    
        }

        $review->delete();

        return response()->json([
            'message' => 'Review successfuly deleted'
        ]);
    }

    public function changeStatus(Request $request)
    {
        try {
            $this->review->changeStatusModel($request);

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Status Changed Successfully'
            ], 200);
        } catch (Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . 'Line:' . $exception->getLine());
        }
    }
}
