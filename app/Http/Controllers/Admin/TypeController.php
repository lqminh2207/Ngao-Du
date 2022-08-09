<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TypeController extends Controller
{
    protected $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function index()
    {
        return view('admin.types.index');
    }


    public function create()
    {
        return view('admin.types.create');
    }

    public function store(TypeRequest $request)
    {
        $data = $this->type->saveData($request);
        return view('admin.types.index')->with('message', 'Destination successfully create');
    }

    public function getData(Request $request) 
    {
        if($request->ajax()) {
            return $this->type->getDataAjax($request);
        }
    }

    public function edit($id)
    {
        $type = $this->type->find($id);
        return view('admin.types.edit', compact('type'));
    }

    public function update(TypeRequest $request, $id)
    {
        $this->type->updateData($request, $id);
        return redirect()->route('types.index')->with('message', 'Type tour successfully updated');
    }


    public function destroy($id)
    {
        $data = $this->type->find($id);

        if(empty($data)) {
            \abort(404);
        }

        $data->delete();
        return redirect()->route('types.index')->with('mesage', 'Type tour successfully deleted');
    }

    public function changeStatus(Request $request) {
        try {
            $this->type->changeStatusModel($request);
            
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
