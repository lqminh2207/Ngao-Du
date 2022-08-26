<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DestinationController extends Controller
{
    protected $destination;

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    public function getData()
    {
        $data = $this->destination->getAll();

        return response()->json([
            'data' => DestinationResource::collection($data),
            'message' => 'Destination retrieved successfully.'
        ]);
    }

    public function show(Request $request, $id)
    {
        $destination = $this->destination->find($id);
        
        return response()->json([
            'data' => new DestinationResource($destination),
            'message' => 'Destination retrieved successfully.'
        ]);
    }

    public function store(DestinationRequest $request)
    {
        $data = $this->destination->saveData($request);

        return response()->json([
            'data' => new DestinationResource($data),
            'message' => 'Destination created successfully.'
        ]);
    }

    public function update(DestinationRequest $request, $id)
    {
        $data = $this->destination->updateData($request, $id);
        
        return response()->json([
            'data' => new DestinationResource($data),
            'message' => 'Destination updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $destination = $this->destination->findOrFail($id);

        $destination->delete();

        return response()->json([
            'message' => 'Destination deleted successfully.'
        ]);
    }
}
