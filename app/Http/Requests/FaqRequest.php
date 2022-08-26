<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        $question = 'required|string|max:255|unique:faqs,question,null,null,tour_id,'.$this->route('tour_id');

        if($this->route('faq_id') > 0)
        {
                                                        // where column = value
            // unique:table,column,value_skip,column_skip, column,value,column,value,....,
            $question = 'required|string|max:255|unique:faqs,question,'.$this->route('faq_id').',id,tour_id,'.$this->route('tour_id');
        }

        return [
            'question' => $question,
            'answer' => 'required',
            'status' => 'required|numeric|between:1,2'
        ];
    }
}
