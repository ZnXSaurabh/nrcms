<?php

namespace App\Http\Requests\SSE;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'location_id' => 'required|numeric',
                    'name' => 'required|max:255',
                    // 'email' => 'email|max:255|unique:vendors,email', //not reqiued by gaurav
                    'mobile' => 'required|max:255|unique:vendors',
                    'agreement_no' => 'required|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'location_id' => 'required|numeric',
                    'name' => 'required|max:255',
                    // 'email' => 'email|max:255|unique:vendors,email,' . $this->vendor, //not reqiued by gaurav
                    'mobile' => 'required|max:255|unique:vendors,mobile,' . $this->vendor,
                    'agreement_no' => 'required|max:255',
                ];
            }
            default:break;
        }
    }
}
