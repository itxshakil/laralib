<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @property int user_id
 * @property mixed name
 *
 * @author Shakil Alam <itxshakil@gmail.com>
 */
class RequestedBook extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author', 'isbn', 'publisher', 'year', 'message', 'user_id', 'admin_id'];
}
