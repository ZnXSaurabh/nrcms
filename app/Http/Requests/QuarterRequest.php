<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuarterRequest extends FormRequest
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
            'housetype_id' => 'required|numeric',
            'block_id' => 'required|numeric',
            'qtrno' => 'required|max:255',
            'rent' => 'required|max:255',
            'house_area' => 'required|max:255',
            'garages' => 'required|max:255',
            'status' => 'required|max:255',
        ];
    }
}
