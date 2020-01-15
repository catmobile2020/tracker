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
        return [
            'id'=>$this->id,
            'label_name'=>$this->label_name,
            'place_holder'=>$this->place_holder,
            'min_value'=>$this->min_value,
            'max_value'=>$this->max_value,
            'is_required'=>(boolean)$this->is_required,
            'element'=>ElementDataResource::make($this->field),
        ];
    }
}
