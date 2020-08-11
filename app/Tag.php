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
        $slug = $this->createSlug($value);
        while (static::where('slug', $slug)->exists()) {
            $slug = "{$slug}-{$this->id}";
        }
        $this->attributes['slug'] = $slug;
    }

    protected function createSlug($value)
    {
        $count = static::where('slug', 'like', Str::slug($value) . '%')->count();
        $value = ($count > 0) ? ($value . '-' . $count) : $value;
        return Str::slug($value);
    }
}
