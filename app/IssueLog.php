<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueLog extends Model
{
   protected $fillable = ['user_id', 'book_id', 'admin_id'];

   protected $with = ['book', 'user', 'admin'];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
      'returned_at' => 'datetime',
   ];

   public function book()
   {
      return $this->belongsTo(Book::class);
   }
   public function user()
   {
      return $this->belongsTo(User::class);
   }
   public function admin()
   {
      return $this->belongsTo(Admin::class);
   }

   public function scopeReturned($query)
   {
      return $query->whereNotNull('returned_at');
   }

   public function scopeIssued($query)
   {
      return $query->whereNull('returned_at');
   }
}
