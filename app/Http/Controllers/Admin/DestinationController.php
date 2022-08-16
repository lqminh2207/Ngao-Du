<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationRequest;
use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    protected $destination;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    public function index()
    {
        return view('admin.destinations.index');
    }

    public function show(Request $request, $id) 
    {
        $destination = $this->destination->find($id);

        return response()->json([
            'destination' => $destination
        ]);
    }


    public function create()
    {
        return view('admin.destinations.create');
    }


    public function store(DestinationRequest $request)
    {
        $this->destination->saveData($request);

        return response()->json([
            'message' => 'Destination successfuly created'
        ]);
    }

    public function getData(Request $request) 
    {
        if($request->ajax()) {
            return $this->destination->getDataAjax($request);
        }
    }

    public function edit($id)
    {
        $destination = $this->destination->find($id);
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(DestinationRequest $request, $id)
    {
        $this->destination->updateData($request, $id);

        return response()->json([
            'message' => 'Destination successfuly updated'
        ]);
    }

    public function destroy($id)
    {
        $data = $this->destination->find($id);

        if(empty($data)) {
            \abort(404);
        }

        if ($data->image && Storage::exists('image')) {
            Storage::delete($data->image);
        }

        $data->delete();
        return redirect()->route('destinations.index')->with('message', 'Destination successfully deleted');
    }

    public function changeStatus(Request $request) {
        try {
            $this->destination->changeStatusModel($request);
            
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Status Changed Successfully',
            ], 200);
        } catch(Exception $exception) {
            Log::error("Message:" . $exception->getMessage() . 'Line:' . $exception->getLine());
        }
    }
}
