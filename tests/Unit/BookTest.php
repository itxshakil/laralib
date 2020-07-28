<?php

namespace Tests\Unit;

use App\Author;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function book_hasMany_authors()
    {
        $book = factory(Book::class)->create();
        
        $this->assertInstanceOf(Collection::class, $book->authors, "Book's authors relationship fails");
    }
}
