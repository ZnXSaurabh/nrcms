<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
                    'name' => 'required|max:255',
                    'fathername' => 'max:255|string',
                    'email' => 'unique:users,email',
                    'mobile' => 'required|unique:users,mobileno',
                    'pfno' => 'unique:profiles,pfno',
                    'department' => 'required|max:255',
                    'designation' => 'required|max:255',
                    'photo' => 'image|mimes:jpeg,png,jpg|max:1024',
                    'location_id' => 'required|numeric',
                    'area_id' => 'required|numeric',
                    'housetype_id' => 'required|numeric',
                    'block_id' => 'required|numeric',
                    'qtrno' => 'required|numeric',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255',
                    'fathername' => 'max:255|string',
                    'email' => 'unique:users,email,' . $this->user,
                    'mobile' => 'required|unique:users,mobileno,' . $this->user,
                    'department' => 'required|max:255',
                    'designation' => 'required|max:255',
                    'photo' => 'image|mimes:jpeg,png,jpg|max:1024',
                    'location_id' => 'required|numeric',
                    'area_id' => 'required|numeric',
                    'housetype_id' => 'required|numeric',
                    'block_id' => 'required|numeric',
                    'qtrno' => 'required|numeric',
                ];
            }
            default:break;
        }
    }
}
