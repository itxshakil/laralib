<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueLog extends Model
{
   protected $fillable = ['user_id', 'book_id', 'admin_id'];

   protected $with = ['book', 'user', 'admin'];

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
}
