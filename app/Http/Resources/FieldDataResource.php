<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  [
            'id'=>$this->id,
            'label_name'=>$this->label_name,
            'place_holder'=>$this->place_holder,
            'is_required'=>(boolean)$this->is_required,
            'element'=>ElementDataResource::make($this->field),
        ];
        if ($this->field->type == 2)
        {
             $data['min_value'] = $this->min_value;
             $data['max_value'] = $this->max_value;
        }
        if (in_array($this->field->type,[3,4,5]))
        {
            $data['options'] = $this->options;
        }
        return $data;
    }
}
