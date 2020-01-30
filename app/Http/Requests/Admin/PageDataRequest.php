<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageDataRequest extends FormRequest
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
        $data =[
            'title'=>'required',
            'description'=>'required',
            'bg_type'=>'required',
        ];
        if ($this->request->get('bg_type') == 1)
        {
            $data['bg_color'] = 'required';
        }else
        {
            $data['bg_photo'] = 'required';
        }
        return $data;
    }
}
