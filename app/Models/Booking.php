<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'tour_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'requirement',
        'payment_method',
        'payment_status',
        'status',
        'price',
        'people',
        'payment_detail',
        'start_at'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }

    public function rules()
    {
        return [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|string|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/|max:150',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|string|max:255',
            'people' => 'required|numeric',
            'payment_method' => 'required',
            'start_at' => 'required'
        ];
    }

    public function getAll()
    {
        return $this->all();
    }

    public function findById($id)
    {
        return $this->find($id);
    }

    public function checkEmpty($data) 
    {
        return !empty($data) ? Ultilities::clearXSS($data) : '';
    }
    
    public function checkEmptyArray($arr) 
    {
        foreach ($arr as $key => $item)
        {
            $arr[$key] = $this->checkEmpty($item);
        }

        return $arr;
    }

    public function getDataAjax($request) 
    {
        $data = $this->latest();

        if(!empty($request->status)) {
            $data = $data->whereStatus($request->status);
        }   

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('lastname', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)   
            ->addIndexColumn()
            ->editColumn('lastname', function ($data){ 
                return $data->firstname . ' ' . $data->lastname;
            })
            ->addColumn('payment_status', function ($data) {
                return view('action.payment_status', ['checked' => $data->payment_status, 'id' => $data->id]);
            })
            ->addColumn('action', function ($data) {
                return view('action.refund', [
                    'url_refund' => route('stripeRefund', $data->id)
                ]);
            })

            ->rawColumns(['status', 'payment_status'])
            ->make(true);
    }

    public function saveData($request)
    {
        $data = $this->checkEmptyArray([
            'tour_id' => $request->tour_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'people' => $request->people,
            'start_at' => $request->start_at,
        ]);

        $data['city'] = Ultilities::clearXSS($request->city);
        $data['state'] = Ultilities::clearXSS($request->state);
        $data['zip_code'] = Ultilities::clearXSS($request->zip_code);
        $data['country'] = Ultilities::clearXSS($request->country);
        $data['requirement'] = Ultilities::clearXSS($request->requirement);
        $data['payment_method'] = Ultilities::clearXSS($request->payment_method);
        $data['price'] = Ultilities::clearXSS($request->price);
        $booking = $this->create($data);
        
        return $booking;
    }
}
