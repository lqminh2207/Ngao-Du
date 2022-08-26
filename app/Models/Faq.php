<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Faq extends AppModel
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'tour_id',
        'question',
        'answer',
        'status'
    ];

    public function tour() 
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getByTourId($tour_id)
    {
        return $this->where('tour_id', $tour_id)->get();
    }

    public function getDataAjax($request) {
        $data = $this->latest();

        if(!empty($request->tour_id)) {
            $data = $data->whereTourId($request->tour_id);
        }

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('title', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data) 
            ->addIndexColumn()
            ->editColumn('status', function($data) {
                return view('action.switch', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->addColumn('action', function ($data) {
                return view('action.action', [
                    'id' => $data->id,
                    'edit_modal' => route('faqs.edit', [$data->tour_id, $data->id]),
                    'url_destroy' => route('faqs.destroy', $data->id),
                ]);
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function saveData($request) 
    {
        $input = $request->only('tour_id', 'question', 'answer');
        $input['tour_id'] = !empty($request->tour_id) ? Ultilities::clearXSS($request->tour_id) : '';
        $input['question'] = !empty($request->question) ? Ultilities::clearXSS($request->question) : '';
        $input['answer'] = !empty($request->answer) ? $request->answer : '';
        $data = $this->create($input);

        return $data;
    }

    public function updateData($request, $tour_id, $id) 
    {
        $faq = $this->find($id);
        $input['question'] = !empty($request->question) ? Ultilities::clearXSS($request->question) : '';
        $input['answer'] = !empty($request->answer) ? $request->answer : '';
        $data = $faq->update($input);

        return $faq;
    }
}
