<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rollno'
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

    // public function issued()
    // {
    //     return $this->belongsToMany(Book::class)->withTimestamps();
    // }

    public function issue_logs()
    {
        return $this->hasMany(IssueLog::class);
    }

    public function issued()
    {
        return $this->hasMany(IssueLog::class)->issued();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function image()
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
