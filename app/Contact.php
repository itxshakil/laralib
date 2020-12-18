<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class Contact extends Model
{
    protected  $fillable = ['name','email','mobile','message'];
}
