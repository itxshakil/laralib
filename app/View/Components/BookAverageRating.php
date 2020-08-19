<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BookAverageRating extends Component
{
    public $averageRating;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($averageRating = 0)
    {
        $this->averageRating =  $averageRating;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.book-average-rating');
    }
}
