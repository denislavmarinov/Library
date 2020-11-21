<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NationalitiesRequest extends FormRequest
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
            'nationality' => 'required|min:3|max:60',
            'history_link' => 'required',
            'flag' => 'required|mimes:png/jpg/jpeg'
        ];
    }
}
