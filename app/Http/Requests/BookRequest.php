<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|min:5|max:200',
            'isbn' => 'required|min:10|max:30',
            'pages' => 'required|max:11',
            'short_content' => 'required|min:150',
            'book_file' => 'required|mimes:pdf',
            'author' => 'required',
            'edition' => 'required|max:11',
            'genre' => 'required',
        ];
    }
}
