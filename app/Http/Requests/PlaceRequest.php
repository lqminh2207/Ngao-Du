<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
        $title = 'required|max:255|unique:places,title,null,null,itinerary_id,'.$this->route('itineraries');

        if($this->route('place') > 0)
        {
            $title = 'required|max:255|unique:places,title,'.$this->route('place').',id,itinerary_id,'.$this->route('itineraries');
        }

        return [
            'title' => $title,
            'content' => 'required'
        ];
    }
}
