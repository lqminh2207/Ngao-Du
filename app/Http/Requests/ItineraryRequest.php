<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItineraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $title = 'required|max:255|unique:itineraries,title,null,null,tour_id,'.$this->route('tour_id'); 

        if ($this->route('itinerary') > 0)
        {
            $title = 'required|max:255|unique:itineraries,title,'.$this->route('itinerary').',id,tour_id,'.$this->route('tour_id');
        }

        return [
            'title' => $title
        ];
    }
}
