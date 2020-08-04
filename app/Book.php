<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'language', 'count'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isbn' => 'integer',
        'count' => 'integer'
    ];


    public function authors()
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    function getAuthorsId()
    {
        return collect($this->authors()->select('id')->get())->map(function ($author) {
            return $author->id;
        })->flatten();
    }

    public function issuer()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function issue_logs()
    {
        return $this->hasMany(IssueLog::class);
    }
}
