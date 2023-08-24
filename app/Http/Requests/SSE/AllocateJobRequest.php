<?php

namespace App\Http\Requests\SSE;

use Illuminate\Foundation\Http\FormRequest;

class AllocateJobRequest extends FormRequest
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
            'estimated_days' => 'required|numeric',
            'vendor_id' => 'required|numeric',
            'resource_id' => 'required|numeric'
        ];
    }
}
