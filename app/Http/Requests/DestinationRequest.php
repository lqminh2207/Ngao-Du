<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
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
        $title = 'required|string|max:100|unique:destinations,title';
        $slug = 'required|string|max:100|unique:destinations,slug';
        $image = 'required|mimes:jpg,jpeg,png,gif,svg|max:10240';

        if($this->route('destination') > 0) {
            $title = 'required|string|max:100|unique:destinations,title,'.$this->route('destination');
            $slug = 'required|string|max:100|unique:destinations,slug,'.$this->route('destination');
            $image = 'mimes:jpg,jpeg,png,gif,svg|max:10240'.$this->route('destination');
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'image' => $image,
            'status' => 'required|numeric|between:1,2'
        ];
    }
}
