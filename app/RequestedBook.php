<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedBook extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author', 'isbn', 'publisher', 'year', 'message', 'user_id', 'admin_id'];
}
