<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validated)
 * @method static paginate(int $int)
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'introduction', 'email'];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
