<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormDataResource extends JsonResource
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
            'title'=>$this->title,
            'description'=>$this->description,
            'bg_color'=>$this->bg_color,
            'place'=>$this->place,
            'btn_text'=>$this->btn_text,
            'btn_color'=>$this->btn_color,
            'logo'=>$this->logo,
            'pages'=>PageDataResource::collection($this->pages),
        ];
    }
}
