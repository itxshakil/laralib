<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rating;

class RatingController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        return $rating->delete();
    }
}
