<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','description','bg_color','btn_text','btn_color','form_id'];

    public function form()
    {
        return $this->belongsTo(Form::class)->withDefault();
    }

    public function fields()
    {
        return $this->hasMany(PageFields::class);
    }

    public function trash()
    {
        $this->delete();
    }
}
