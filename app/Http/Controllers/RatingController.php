<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $this->authorize('create', [Rating::class, $book]);

        $request->validate([
            'score' => ['required', 'numeric', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:255'],
        ]);

        $rating = $book->ratings()->create([
            'score' => $request->score,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return redirect(route('books.show',$book));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
