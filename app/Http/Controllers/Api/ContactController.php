<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\Tour;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $tour;
    protected $contact;

    public function __construct(Tour $tour, Contact $contact)
    {
        $this->tour = $tour;
        $this->contact = $contact;
    }

    public function getAllData()
    {
        $data = $this->contact->getAll();

        return response()->json([
            'data' => ContactResource::collection($data),
            'message' => 'Contact retrieved successfully.'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->contact->rules());
        $data = $this->contact->saveData($request);

        return response()->json([
            'data' => new ContactResource($data),
            'message' => 'Contact created successfully.'
        ]);
    }

    public function destroy($id)
    {
        $contact = $this->contact->findOrFail($id);

        $contact->delete();

        return response()->json([
            'message' => 'Contact deleted successfully.'
        ]);
    }
}
