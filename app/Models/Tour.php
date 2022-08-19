<?php

namespace App\Models;

use App\Libraries\Ultilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\StorageImageTrait;
use Yajra\DataTables\Facades\DataTables;

class Tour extends AppModel
{
    use HasFactory;
    use StorageImageTrait;

    protected $table = 'tours';

    protected $fillable = [
        'destination_id',
        'type_id',
        'title',
        'slug',
        'duration',
        'price',
        'status',
        'trending',
        'image',
        'overview',
        'video',
        'image_360',
        'additional',
        'map',
        'departure',
        'include',
        'is_interested',
        'is_culture',
        'meta_title',
        'meta_description'
    ];

    public function getByIdTour($id) 
    {
        return $this->find($id);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }

    public function type() 
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function itineraries() 
    {
        return $this->hasMany(Itinerary::class);
    }

    public function faqs() 
    {
        return $this->hasMany(Faq::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getDataAjax($request) 
    {
        $data = $this->latest();

        if(!empty($request->status)) {
            $data = $data->whereStatus($request->status);
        }   

        if(!empty($request->trending)) {
            $data = $data->whereTrending($request->trending);
        }   

        if(!empty($request->type)) {
            $data = $data->whereTypeId($request->type);
        }

        if(!empty($request->destination)) {
            $data = $data->whereDestinationId($request->destination);
        }

        if(!empty($request->search)) {
            $search = Ultilities::clearXSS($request->search);
            $data->where(function ($result) use ($search) {
                $result->where('title', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%');
            });
        }

        return DataTables::of($data)   
            ->addIndexColumn()
            ->addColumn('image', function ($data){
                return '<img src="'.$data->img.'" alt="" width="120" height="120">';
            })
            ->editColumn('status', function ($data) {
                return view('action.switch', ['checked' => $data->status, 'id' => $data->id]);
            })
            ->editColumn('trending', function ($data) {
                return view('action.switch-trending', ['checked' => $data->trending, 'id' => $data->id]);
            })
            ->addColumn('title', function ($data) {
                return '<h6 class="m-0">'. $data->title .'</h6>
                <p class="m-1">'. $data->destination->title .'</p>
                <p class="m-0">'. '(' . $data->type->title . ')' .'</p>';
            })
            ->addColumn('overview', function ($data) {
                return $data->overview;
            })
            ->addColumn('include', function ($data) {
                return $data->include;
            })
            ->addColumn('departure', function ($data) {
                return $data->departure;
            })
            ->addColumn('additional', function ($data) {
                return $data->additional;
            })
            ->addColumn('action', function ($item) {
                return view('action.action', [
                    'message' => null,
                    'url_show' => null,'title' => 'tour',
                    'url_edit' => route('tours.edit', $item->id),
                    'url_destroy' => route('tours.destroy', $item->id),
                ]);
            })
            ->editColumn('price', function ($data) {
                return '$ ' . $data->price ;
            })
            ->editColumn('duration', function ($data) {
                if ($data->duration == 1) 
                    return 'A day';
                else if ($data->duration == 2) 
                    return $data->duration . ' days ' . $data->duration - 1 . ' night';
                else
                    return $data->duration . ' days ' . $data->duration - 1 . ' nights';
            })
            ->addColumn('details', function($data) {
                return view('action.info_tour', [
                    'itineraries' => route('itineraries.show', [$data->id]),
                    'faqs' => route('faqs.show', [$data->id]),
                    'galleries' => route('galleries.show', $data->id),  
                    'reviews' => route('reviews.show', $data->id)
                ]);
            })
            ->rawColumns(['action', 'title', 'image', 'overview', 'include', 'departure', 'additional', 'status', 'trending', 'duration'])
            ->make(true);
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

    public function saveData($request) {
        $data = $this->checkEmptyArray([
            'destination_id' => $request->destination_id,
            'type_id' => $request->type_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'status' => $request->status,
            'trending' => $request->trending,
            'duration' => $request->duration,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        $data['overview'] = $request->overview;
        $data['include'] = $request->include;
        $data['departure'] = $request->departure;
        $data['map'] = Ultilities::clearXSS($request->map);
        $data['image_360'] = Ultilities::clearXSS($request->image_360);
        $data['video'] = Ultilities::clearXSS($request->video);
        $data['additional'] =  $request->additional;
        $data['is_interested'] = Ultilities::clearXSS($request->is_interested);
        $data['is_culture'] = Ultilities::clearXSS($request->is_culture);

        $dataUploadImage = $this->storageTraitUpload($request, 'image', 'tours');
        if (!empty($dataUploadImage)) {
            $data['image'] = $dataUploadImage['file_path'];
        }

        $dataUploadImage = $this->storageTraitUpload($request, 'image_360', 'tours');
        if (!empty($dataUploadImage)) {
            $data['image_360'] = $dataUploadImage['file_path'];
        }

        $data = $this->create($data);

        return $data;
    }

    public function updateData($request, $id) {
        $tour = $this->find($id);

        $data = $this->checkEmptyArray([
            'destination_id' => $request->destination_id,
            'type_id' => $request->type_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'status' => $request->status,
            'trending' => $request->trending,
            'duration' => $request->duration,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        $data['overview'] = $request->overview;
        $data['include'] = $request->include;
        $data['departure'] = $request->departure;
        $data['map'] = Ultilities::clearXSS($request->map);
        $data['image_360'] = Ultilities::clearXSS($request->image_360);
        $data['video'] = Ultilities::clearXSS($request->video);
        $data['additional'] =  $request->additional;
        $data['is_interested'] = Ultilities::clearXSS($request->is_interested);
        $data['is_culture'] = Ultilities::clearXSS($request->is_culture);

        $dataUploadImage = $this->storageTraitUpload($request, 'image', 'tours');
        if (!empty($dataUploadImage)) {
            $data['image'] = $dataUploadImage['file_path'];
        }

        $dataUploadImage = $this->storageTraitUpload($request, 'image_360', 'tours');
        if (!empty($dataUploadImage)) {
            $data['image_360'] = $dataUploadImage['file_path'];
        }

        $data = $tour->update($data);

        return $data;
    }

    public function getImgAttribute() {
        return asset('storage/tours/' . $this->getRawOriginal('image'));
    }

    public function getDurationTourAttribute()
    {
        if ($this->duration == 1)
        {
            return 'A day';
        }
        else if($this->duration == 2)
        {
            return $this->duration . ' days ' . $this->duration - 1 . ' night';
        } else
        {
            return $this->duration . ' days ' . $this->duration - 1 . ' nights';
        }
    }

    // client
    public function getAttrTourHomepage()
    {
        return $this->whereStatus(self::ACTIVE)->whereIsInterested(self::ACTIVE)->latest()->take(8)
        ->whereHas('destination', function(Builder $query) {
            return $query->whereStatus(self::ACTIVE);
        })
        ->whereHas('type', function(Builder $query) {
            return $query->whereStatus(self::ACTIVE);
        })
        ->get();
    }

    public function getCulTourHomepage()
    {
        return $this->whereStatus(self::ACTIVE)->whereIsCulture(self::ACTIVE)->latest()->take(8)
        ->whereHas('destination', function(Builder $query) {
            return $query->whereStatus(self::ACTIVE);
        })
        ->whereHas('type', function(Builder $query) {
            return $query->whereStatus(self::ACTIVE);
        })
        ->get();
    }

    public function getBySlug($slug)
    {
        return $this->whereSlug($slug)->first();
    }

    public function getAllTour()
    {
        return $this->whereStatus(self::ACTIVE)
        ->whereHas('destination', function(Builder $query) {
            return $query->whereStatus(self::ACTIVE);
        })
        ->whereHas('type', function(Builder $query) {
            return $query->whereStatus(self::ACTIVE);
        })
        ->paginate(3);
    }

    public function getRelatedTour($tour_id)
    {
        $tour = $this->findOrFail($tour_id);
        $destination_id = null;
        $type_id = null;

        if($tour->destination) {
            $destination_id = $tour->destination->id;
        }

        if($tour->type) {
            $type_id = $tour->type->id;
        }

        return $this->whereStatus(self::ACTIVE)->where('id', '!=', $tour_id)   
        ->where(function ($query) use ($destination_id, $type_id) {
            $query->WhereHas('destination', function ($query) use ($destination_id) {
                $query->whereStatus(self::ACTIVE)->where('id', $destination_id);
            })
            ->orWhereHas('type', function ($query) use ($type_id) {
                $query->whereStatus(self::ACTIVE)->where('id', $type_id);
            });
        })
        ->latest()->get();
    }

    public function getReview($tour_id)
    {
        return $this->find($tour_id)->reviews()->whereStatus(self::ACTIVE)->latest()->paginate(2);
    }

    public function countStar($tour_id)
    {
        // $tour = $this->findOrFail($tour_id)->withSum('reviews', 'star')->withAvg('reviews', 'star')->get();
        // $review_id = $tour->review->id;
        // dd($tour);
        $five_star = $this->find($tour_id)->reviews()->whereStatus(self::ACTIVE)
        ->whereStar(5)->count();
        $four_star = $this->find($tour_id)->reviews()->whereStatus(self::ACTIVE)
        ->whereStar(4)->count();
        $three_star = $this->find($tour_id)->reviews()->whereStatus(self::ACTIVE)
        ->whereStar(3)->count();
        $two_star = $this->find($tour_id)->reviews()->whereStatus(self::ACTIVE)
        ->whereStar(2)->count();
        $one_star = $this->find($tour_id)->reviews()->whereStatus(self::ACTIVE)
        ->whereStar(1)->count();
        $total = $five_star + $four_star + $three_star + $two_star + $one_star;
        
        if($total != 0) {
            $average_one = ($one_star / $total)*100;
            $average_two = ($two_star / $total)*100;
            $average_three = ($three_star / $total)*100;
            $average_four = ($four_star / $total)*100;
            $average_five = ($five_star / $total)*100;
            $average = ($five_star*5 + $four_star*4 + $three_star*3 + $two_star*2 + $one_star*1) / $total;
        }

        if(($this->find($tour_id)->reviews()->count()) > 0) {
            $average = round($average, 1);
            $average_one = round($average_one, 3);
            $average_two = round($average_two, 3);
            $average_three = round($average_three, 3);
            $average_four = round($average_four, 3);
            $average_five = round($average_five, 3);
        } else {
            $average = '0';
            $average_one = 0;
            $average_two = 0;
            $average_three = 0;
            $average_four = 0;
            $average_five = 0;
        }

        return [
            'five_star' => $five_star ,
            'four_star' => $four_star,
            'three_star' => $three_star,
            'two_star' => $two_star,
            'one_star' => $one_star,
            'average' => $average,
            'average_one' => $average_one,
            'average_two' => $average_two,
            'average_three' => $average_three,
            'average_four' => $average_four,
            'average_five' => $average_five,
            'total' => $total
        ];

        // return $tour;
    }
}
