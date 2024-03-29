<?php

namespace App\Policies;

use App\Book;
use App\User;
use App\Rating;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Rating $rating
     * @return mixed
     */
    public function view(User $user, Rating $rating)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param Book $book
     * @return mixed
     */
    public function create(User $user, Book $book)
    {
        return $this->isIssued($user, $book) && $this->isNotRated($user, $book);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Rating $rating
     * @return mixed
     */
    public function update(User $user, Rating $rating)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Rating $rating
     * @return mixed
     */
    public function delete(User $user, Rating $rating)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Rating $rating
     * @return mixed
     */
    public function restore(User $user, Rating $rating)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Rating $rating
     * @return mixed
     */
    public function forceDelete(User $user, Rating $rating)
    {
        //
    }

    /***
     * Determine if Book is issued to User
     *
     * @param $user
     * @param $book
     *
     * @return boolean
     */
    private function isIssued($user, $book)
    {
        return $user->issue_logs()->pluck('book_id')->contains($book->id);
    }

    /***
     * Returns true if user has not rated the book else true
     *
     * @param $user
     * @param $book
     *
     * @return boolean
     */
    private function isNotRated($user, $book)
    {
        return !$book->ratings->pluck('user_id')->contains($user->id);
    }
}
