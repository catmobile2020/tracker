<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFields extends Model
{
    protected $fillable = ['label_name','place_holder','min_value','max_value','is_required','options','page_id','field_id'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = serialize(array_filter($value));
    }

    public function getOptionsAttribute()
    {
        return unserialize($this->attributes['options']);
    }
}
