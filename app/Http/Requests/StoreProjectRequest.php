<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:projects,title|min:5|max:100',
            'slug' => 'max:255',
            'description' => 'nullable',
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => 'exists:technologies,id',
            'cover_image' => 'nullable|image|max:300'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo é obbligatorio',
            'title.min' => 'Il titolo deve essere almeno :min caratteri',
            'title.max' => 'Il titolo deve essere almeno :max caratteri',
            'slug.max' => "Lo slug puó essere massimo :max caratteri",
        ];
    }
}
