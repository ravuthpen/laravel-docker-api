<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       // return false;
       return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
            //
            if(request()->isMethod('post')){
                return[
                    'user_id' =>'required|string|max:258',
                    'username'=>'required|string|max:258',
                    'image'=>'required|image|mimes:jpen,png,jpg,gif,svg|max:2048'

                ];
            } else {
                return[
                    'user_id' =>'required|string|max:258',
                    'username'=>'required|string|max:258',
                    'image'=>'required|image|mimes:jpen,png,jpg,gif,svg|max:2048',
                ];
            }
    }

    public function messages(){
        if(request()->isMethod('post')){
            return[
                'user_id.required'=>'User Id is required',
                'username.required'=>'User Name is required',
                'image.required'=>'Image is required',
            ];
        } else{
            return[
                'user_id.required'=>'User Id is required',
                'username.required'=>'User Name is required',
            ];
        }
    }
}
