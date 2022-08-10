<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TourController extends Controller
{
    protected $tour;
    protected $destination;
    protected $type;

    public function __construct(Type $type, Destination $destination, Tour $tour)
    {
        $this->type = $type;
        $this->destination = $destination;
        $this->tour = $tour;
    }

    public function index()
    {
        $destinations = $this->destination->takeAll();
        $types = $this->type->takeAll();
        return view('admin.tours.index', compact('destinations', 'types'));
    }

    public function create()
    {
        $destinations = $this->destination->takeAll();
        $types = $this->type->takeAll();
        return view('admin.tours.create', compact('destinations', 'types'));
    }

    public function store(TourRequest $request)
    {
        try {
            $this->tour->saveData($request);

            return redirect()->route('tours.index')->with('message', 'Tour successfuly created');
        } catch (Exception $exception) {
            dd($exception);
            Log::error("Message:" . $exception->getMessage() . 'Line:' . $exception->getLine());
        }
    }

    public function getData(Request $request) 
    {
        if ($request->ajax()) 
        {
            return $this->tour->getDataAjax($request);
        }
    }

    public function edit($id)
    {
        $tour = $this->tour->find($id);
        $destinations = $this->destination->takeAll();
        $types = $this->type->takeAll();
        return view('admin.tours.edit', compact('destinations', 'types', 'tour'));
    }

    public function update(TourRequest $request, $id)
    {
        $this->tour->updateData($request, $id);
        return redirect()->route('tours.index')->with('message', 'Tour successfuly updated');
    }

    public function destroy($id)
    {
        $tour = $this->tour->find($id);

        if (empty($tour)) {
            \abort(404);
        }

        $tour->delete();
        return redirect()->route('tours.index')->with('message', 'Tour successfuly deleted');
    }

    public function changeStatus(Request $request)
    {
        try {
            $this->tour->changeStatusModel($request);

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Status Changed Successfully',
            ], 200);
        } catch (Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . 'Line:' . $exception->getLine());
        }
    }

    public function changeStatusTrending(Request $request)
    {
        try {
            $this->tour->changeStatusModelTrending($request);

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Status Changed Successfully',
            ], 200);
        } catch (Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . 'Line:' . $exception->getLine());
        }
    }
}
