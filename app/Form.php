<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['title','description','bg_color','date','place','btn_text','btn_color'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getLogoAttribute()
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

    public function forms()
    {
        return $this->hasMany(UserForms::class);
    }

}
