<?php

namespace Tests\Unit;

use App\Author;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function author_hasMany_books()
    {
        $author = factory(Author::class)->create();

        $this->assertInstanceOf(Collection::class, $author->books, "Author's books relationship fails");
    }
}
