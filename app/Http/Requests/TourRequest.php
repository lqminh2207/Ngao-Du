<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
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
        $title = 'required|string|max:100|unique:tours,title';
        $slug = 'required|string|max:255|unique:tours,slug';
        $image = 'required|mimes:jpg,jpeg,png,gif,svg|max:10240';

        if ($this->route('tour') > 0) { 
            $title = 'required|string|max:100|unique:tours,title,'.$this->route('tour');    
            $slug = 'required|string|max:100|unique:tours,slug,'.$this->route('tour');
            $image = 'mimes:jpg,jpeg,png,gif,svg|max:10240'.$this->route('tour');
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'image' => $image,
            'destination_id' => 'required',
            'type_id' => 'required',
            'duration' => 'required|integer|gt:0',
            'price' => 'required|numeric|gt:0',
            'is_interested' => 'required|numeric|between:1,2',
            'is_culture' => 'required|numeric|between:1,2',
            'trending' => 'required|numeric|between:1,2',
            'status' => 'required|numeric|between:1,2'
        ];
    }
}
