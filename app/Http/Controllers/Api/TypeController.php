<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use Exception;
use Illuminate\Support\Facades\Log;

class TypeController extends Controller
{
    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function getData(Request $request)
    {
        $data = $this->type->getAll();

        return response()->json([
            // 'data' => $data
            'data' => TypeResource::collection($data),
            'message' => 'Types retrieved successfully.'
        ]);
    }

    public function show(Request $request, $id)
    {
        $type = $this->type->find($id);
        
        return response()->json([
            'data' => $type,
            'message' => 'Types retrieved successfully.'
            // 'data' => TypeResource::collection($type),
        ]);
    }

    public function store(TypeRequest $request)
    {
        $data = $this->type->saveData($request);

        return response()->json([
            'data' => new TypeResource($data),
            'message' => 'Types created successfully.'
        ]);
    }

    public function update(TypeRequest $request, $id)
    {
        $data = $this->type->updateData($request, $id);

        return response()->json([
            'data' => new TypeResource($data),
            'message' => 'Types updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $type = $this->type->findOrFail($id);

        $type->delete();

        return response()->json([
            'message' => 'Type deleted successfully.'
        ]);
    }
}
