<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title'=>['required', 'min:3', Rule::unique('posts', 'title')->ignore($this->route('post'))],
            'description'=>['required','min:10'],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Title is required ya negm, please fill it out.',
            'title.min'=>'Title must be at least 3 characters long ya negm.',
            'title.unique'=>'Title must be unique ya negm, please choose another title.',
            'description.required'=>'Description is required ya negm, please fill it out.',
            'description.min'=>'Description must be at least 10 characters long ya negm.',
        ];
    }
}
