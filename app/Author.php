<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'introduction', 'email'];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
