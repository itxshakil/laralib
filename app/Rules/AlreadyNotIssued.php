<?php

namespace App\Rules;

use App\Book;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class AlreadyNotIssued implements Rule
{
    public $user;

    /**
     * Create a new rule instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user  = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $book = Book::where('isbn', $value)->first();
        if ($this->userHasIssuedBook($book)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Book is already issued to user.';
    }

    private function userHasIssuedBook(Book $book)
    {
        return $this->user->issue_logs()->issued()->pluck('book_id')->contains($book->id);
    }
}
