<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $validated)
 * @method static paginate(int $int)
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'introduction', 'email'];

    public function books():BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }
}
