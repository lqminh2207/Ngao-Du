<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    protected $faq;

    public function __construct(Faq $faq, Tour $tour)
    {
        $this->faq = $faq;
        $this->tour = $tour;
    }

    public function show($tour_id)
    {
    return view('admin.faqs.index', compact('tour_id'));
    }

    public function showInfo(Request $request ,$id) 
    {
        $faq = $this->faq->find($request->id);

        return response()->json([
            'faq' => $faq
        ]);
    }

    public function getData(Request $request)
    {
        if($request->ajax()) 
        {
            return $this->faq->getDataAjax($request);
        }
    }

    public function store(FaqRequest $request, $tour_id)
    {
        $this->faq->saveData($request, $tour_id);

        return response()->json([
            'message' => 'Faq successfuly created'
        ]);
    }

    public function update(FaqRequest $request, $tour_id, $id)
    {
        $this->faq->updateData($request, $tour_id, $id);

        return response()->json([
            'message' => 'Faq successfuly updated'
        ]);
    }

    public function destroy($id)
    {
        $faq = $this->faq->find($id);

        if(empty($faq)) {
            \abort(404);
        }

        $faq->delete();

        return response()->json([
            'message' => 'Faq successfuly deleted'
        ]);
    }

    public function changeStatus(Request $request ,$id)
    {
        try {
            $this->faq->changeStatusModel($request);

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Status Changed Successfully'
            ]);
        } catch (Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . 'Line:' . $exception->getLine());
        }

    }
}
