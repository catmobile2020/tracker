<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFields extends Model
{
    protected $fillable = ['label_name','place_holder','min_value','max_value','is_required','page_id','field_id'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
