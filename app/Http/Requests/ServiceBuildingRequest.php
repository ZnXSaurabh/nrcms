<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceBuildingRequest extends FormRequest
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
            'location_id' => 'required|numeric',
            'area_id' => 'required|numeric',
            'name' => 'required|max:255',
            'area_covered' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            // 'email' => 'required|email|max:255',
            'status' => 'required',
        ];
    }
}
