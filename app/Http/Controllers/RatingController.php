<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\StoreRating;
use App\Rating;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRating  $request
     * @param  Book                            $book
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRating $request, Book $book): Redirector|RedirectResponse|Application
    {
        $book->ratings()->create([
            'score' => $request->score,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return redirect(route('books.show',$book))->with('flash','Rating is saved successfully.');
    }
}
