<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstOrCreate(array $data)
 */
class Tag extends Model
{
    use HasFactory;

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
