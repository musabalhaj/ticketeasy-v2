<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
        return [
            'title'=>'required|min:4|max:80',
            'description'=>'required|min:4|max:700',
            'tickets'=>'required|Numeric',
            'price'=>'required|Numeric',
            'date'=>'required|Date',
            'location'=>'required||min:4|max:50',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ];
    }
}
