<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['score', 'comment', 'user_id', 'product_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
