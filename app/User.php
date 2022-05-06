<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @method static create(array $array)
 * @method static find($user_id)
 *
 * @author Shakil Alam <itxshakil@gmail.com>
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rollno', 'course_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'rollno' => 'integer'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // public function issued()
    // {
    //     return $this->belongsToMany(Book::class)->withTimestamps();
    // }

    public function issue_logs():HasMany
    {
        return $this->hasMany(IssueLog::class);
    }

    public function issued()
    {
        return $this->hasMany(IssueLog::class)->issued();
    }

    public function course():BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function ratings():HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function image():MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function scopeCourse($query, $course)
    {
        return $query->where('course_id', $course);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")->orWhere('rollno', 'like', "%$search%");
    }

    public function isRated($book): bool
    {
        return $this->ratings()->pluck('book_id')->contains($book->id);
    }
}
