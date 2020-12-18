<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rating;
use Exception;

class RatingController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Rating $rating
     * @return bool
     * @throws Exception
     */
    public function destroy(Rating $rating)
    {
        return $rating->delete();
    }
}
