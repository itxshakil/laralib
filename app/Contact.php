<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

/**
 * @method static create(array $data)
 */
class Contact extends Model
{
    protected  $fillable = ['name', 'email', 'mobile', 'message'];

    protected static function booted()
    {
        static::created(function (Contact $contact) {
            Notification::route('mail', config('mail.admin.address'))
                ->notify(new \App\Notifications\ContactNotification($contact));
        });
    }
}
