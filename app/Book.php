<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    // protected $fillable = ['title', 'isbn', 'language'];

    public function authors()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
