<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
        $title = 'required|string|max:100|unique:types,title';

        if($this->route('type') > 0) {
            $title = 'required|string|max:100|unique:types,title,'.$this->route('type');
        }

        return [
            'title' => $title,
            'status' => 'required|numeric|between:1,2'
        ];
    }
}
