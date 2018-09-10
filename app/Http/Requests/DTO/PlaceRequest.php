<?php

namespace App\Http\Requests\DTO;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\Code;

/**
 * Class PlaceRequest
 * @package App\Http\Requests\DTO
 */
class PlaceRequest extends FormRequest
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
            'place_name' => 'required'
        ];

    }

    /**
     * @param array $errors
     * @return mixed
     */
    public function response(array $errors)
    {
        
        $statusArray['status'] = [
            'success' => false,
            'http_code' => Code::VALIDATION_ERROR_CODE,
            'message' => array_map(function($errors){
                foreach($errors as $key=>$value){
                    return $value;
                }
            },$errors)
        ];
        
        return $this->respond($statusArray);
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data , $headers=[] ){
        return \Response::json($data);
    }

    /**
     * OverRiding messages function
     * @return [type] [description]
     */
    public function messages()
    {
        $messages=[
            'place_name.required' => 'Place Name is required',
        ];

        return $messages;
    }
}
