<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class BookAverageRating extends Component
{
    public int $averageRating;

    /**
     * Create a new component instance.
     *
     * @param int $averageRating
     */
    public function __construct(int $averageRating = 0)
    {
        $this->averageRating =  $averageRating;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.book-average-rating');
    }
}
