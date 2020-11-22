<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenresRequest extends FormRequest
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
            'genre' => 'required|min:3|max:60',
            'description' => 'required|min:10|max:1000'
        ];
    }
}
