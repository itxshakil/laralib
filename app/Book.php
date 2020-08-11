<?php

namespace App;

use App\Tag;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Nicolaslopezj\Searchable\SearchableTrait;

class Book extends Model
{
    use SearchableTrait;

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

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'books.title' => 10,
            'books.isbn' => 10,
            'authors.name' => 8,
        ],
        'joins' => [
            'authors' => ['books.id', 'authors.books.id'],
        ],
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

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('authors', function (Builder $query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->orWhere('title', 'like', "%$search%")->orWhere('isbn', 'like', "%$search%");
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('score');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
