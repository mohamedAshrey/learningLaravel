<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required'],
            'description'=>['required','min:3'],
        
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Title is required, please fill it out.',
            'description.required'=>'Description is required, please fill it out.',
            'description.min'=>'Description must be at least 3 characters long.',
        ];
    }
}
