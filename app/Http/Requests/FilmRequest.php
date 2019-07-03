<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
          'title' => 'required|max:255|unique:films,title,' . $this->id,
          'thumb' => 'required',
          'slug' => 'unique:films,slug,'.$this->id
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
          'title.unique' => 'Film titles must be unique. Perhaps you’re adding a film that’s already been added?',
          'slug.unique' => 'The slug is used for the film’s URL so must be unique.'
        ];
    }
}
