<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Nicolaslopezj\Searchable\SearchableTrait;

/**
 * @property mixed id
 * @method static search(array|string|null $query)
 * @method static firstWhere(string $string, $isbn)
 * @method static create(array $only)
 */
class Book extends Model
{
    use SearchableTrait, SoftDeletes, HasFactory;

    protected $fillable = ['title', 'isbn', 'language', 'count'];

    protected $appends = ['average_rating'];

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


    public function authors():BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    // public function issuer()
    // {
    //     return $this->belongsToMany(User::class)->withTimestamps();
    // }

    public function issue_logs():HasMany
    {
        return $this->hasMany(IssueLog::class);
    }

    public function ratings():HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function tags():MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getAverageRatingAttribute()
    {
        return Cache::remember("book.{$this->id}.averageRating", 600, function () {
            return $this->ratings()->avg('score') ?? 0;
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('authors', function (Builder $query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->orWhere('title', 'like', "%$search%")->orWhere('isbn', 'like', "%$search%");
    }
}
