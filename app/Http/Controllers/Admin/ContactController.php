<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return view('admin.contacts.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->contact->rules());
        $this->contact->saveData($request);

        return redirect()->back()->with('message', 'Your message has been successfully sent');
    }

    public function getData(Request $request) {
        if ($request->ajax()) {
            return $this->contact->getDataAjax($request);
        }
    }

    public function destroy($id)
    {
        $contact = $this->contact->find($id);

        if(empty($contact)) {
            \abort(404);
        }

        $contact->delete();
        return redirect()->route('contacts.index')->with('message', "Contact successfuly deleted");
    }

    public function changeStatus(Request $request) 
    {
        try {
            $this->contact->changeStatusModel($request);

            return response()->json([
                'code' => 200,
                'success' => true,
            ], 200);
        } catch (Exception $exception) {
            Log::error("Message:" . $exception->getMessage() . 'Line ' . $exception->getLine());
        }
    }
}
