<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'comp_type' => 'required|max:255',
            'location_id' => 'nullable|numeric',
            'area_id' => 'nullable|numeric',
            'service_building_id' => 'required_if:comp_type,"Service Building"',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:7120',
        ];
    }
}
