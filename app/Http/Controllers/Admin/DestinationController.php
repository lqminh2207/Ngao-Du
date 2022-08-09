<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationRequest;
use App\Models\Destination;
use Illuminate\Http\Request;

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


    public function create()
    {
        return view('admin.destinations.create');
    }


    public function store(DestinationRequest $request)
    {
        $data = $this->destination->saveData($request);
        return view('admin.types.index')->with('message', 'Destination successfully create');
    }

    public function getData(Request $request) 
    {
        if($request->ajax()) {
            $this->destination->getDataAjax($request);
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
        return redirect()->route('destinations.index')->with('message', 'Destination successfully updated');
    }

    public function destroy($id)
    {
        $data = $this->destination->find($id);

        if(empty($data)) {
            \abort(404);
        }

        $data->delete();
        return redirect()->route('destinations.index')->with('message', 'Destination successfully deleted');
    }
}
