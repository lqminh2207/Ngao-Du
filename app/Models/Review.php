<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Review extends AppModel
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'tour_id',
        'star',
        'message',
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

    public function rules() 
    {
        return [
            'star' => 'required|numeric|min:1|max:5',
            'message' => 'required|string|max:500',
        ];
    }

    public function getDataAjax($request)
    {
        $data = $this->latest();

        if (!empty($request->tour_id)) {
            $data = $data->whereTourId($request->tour_id);
        }

        if(!empty($request->status)) {
            $data = $data->whereStatus($request->status);
        }

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('star', 'like', '%' . $search . '%')
                ->orWhere('message', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                return view('action.switch', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->addColumn('action', function ($data) {
                return view('action.action', [
                    'model' => $data,
                    'url_destroy' => route('reviews.destroy', [$data->id])
                ]);
            })

            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function saveData($request) 
    {
        $input['tour_id'] = !empty($request->tour_id) ? Ultilities::clearXSS($request->tour_id) : '';
        $input['star'] = !empty($request->star) ? Ultilities::clearXSS($request->star) : '';
        $input['message'] = !empty($request->message) ? Ultilities::clearXSS($request->message) : '';
        $data = $this->create($input);

        return $data;
    }
}
