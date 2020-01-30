<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','description','bg_type','bg_color','btn_text','btn_color','form_id'];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getPhotoAttribute()
    {
        return $this->image->full_url ?? asset('assets/admin/images/default-image.jpg');
    }

    public function trash()
    {
        $photo = public_path().$this->image->url;
        if (is_file($photo))
        {
            @unlink($photo);
            $this->image()->delete();
        }
        $this->delete();
    }

    public function form()
    {
        return $this->belongsTo(Form::class)->withDefault();
    }

    public function fields()
    {
        return $this->hasMany(PageFields::class);
    }
}
