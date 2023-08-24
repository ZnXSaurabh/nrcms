<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;



class AdminRequest extends FormRequest

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

                    'location_id' => 'required',

                    'name' => 'required|max:255',

                    // 'department' => 'required|max:255',

                    // 'designation' => 'required|max:255',

                    'email' => 'required|email|unique:users',

                    'mobile' => 'required|unique:users,mobileno',

                    'role' => 'required|numeric',

                ];

            }

            case 'PUT':

            case 'PATCH':

            {

                return [

                    'location_id' => 'required',

                    'name' => 'required|max:255',

                    // 'department' => 'required|max:255',

                    // 'designation' => 'required|max:255',

                    'email' => 'required|email|unique:users,email,' . $this->admin,

                    'mobile' => 'required|unique:users,mobileno,' . $this->admin,

                    'role' => 'required|numeric',

                ];

            }

            default:break;

        }

    }

}

