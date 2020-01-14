<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'date'=>'required',
            'description'=>'required',
            'place'=>'required',
            'bg_color'=>'required',
        ];
        if ($this->routeIs('admin.forms.update'))
        {
            $data['logo']='image';

        }else
        {
            $data['logo']='required|image';
        }
        return $data;
    }
}
