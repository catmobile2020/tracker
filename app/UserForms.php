<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForms extends Model
{
    protected $fillable  =['form_id','user_id'];

    public function form()
    {
        return $this->belongsTo(Form::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
