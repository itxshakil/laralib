<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'language'];

    public function authors()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
