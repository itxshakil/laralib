<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'language'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isbn' => 'integer',
    ];


    public function authors()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }
}
