<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($tag) {
            $tag->update(['slug' => $tag->name]);
        });
    }

    public function books()
    {
        return $this->morphedByMany(Book::class, 'taggable');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
