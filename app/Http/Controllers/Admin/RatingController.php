<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Response;

class RatingController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return Response
     */
    public function destroy(Rating $rating)
    {
        return $rating->delete();
    }
}
