<?php

namespace App\Http\Requests\SSE;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
                    'vendor_id' => 'required|numeric',
                    'name' => 'required|max:255',
                    // 'email' => 'unique:resources,email', //not reqiued by gaurav 
                    'mobile' => 'required|max:255',
                    'address' => 'required|max:255',
                    'category_id' => 'required|numeric',
                    // 'sub_category_id' => 'required|numeric', //remove by gaurav baliyan
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'vendor_id' => 'required|numeric',
                    'name' => 'required|max:255',
                    // 'email' => 'unique:resources,email,' . $this->resource, //not reqiued by gaurav
                    // 'mobile' => 'required|unique:resources,mobile,' . $this->resource,  //not reqiued by gaurav
                    'address' => 'required|max:255',
                    'category_id' => 'required|numeric',
                    // 'sub_category_id' => 'required|numeric', //remove by gaurav baliyan
                ];
            }
            default:break;
        }
    }
}
