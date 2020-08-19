<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedBook extends Model
{
    protected $fillable = ['name', 'author', 'isbn', 'publisher', 'year', 'message', 'user_id','admin_id'];
}
