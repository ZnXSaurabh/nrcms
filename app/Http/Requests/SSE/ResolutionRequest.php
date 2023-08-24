<?php

namespace App\Http\Requests\SSE;

use Illuminate\Foundation\Http\FormRequest;

class ResolutionRequest extends FormRequest
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
            'resolution' => 'required|string',
            'resolution_images.*' => 'image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
}
