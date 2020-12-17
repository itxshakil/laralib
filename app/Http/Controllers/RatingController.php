<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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

        return redirect(route('books.show',$book))->with('flash','Rating is saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rating $rating
     * @return Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rating $rating
     * @return Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
