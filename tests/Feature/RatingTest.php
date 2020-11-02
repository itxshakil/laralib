<?php

namespace Tests\Feature;

use App\Admin;
use App\Book;
use App\Course;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function user_can_not_rate_books_if_not_issued_to_them()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create(['course_id' => Course::factory()->create()->id]);
        $this->actingAs($user);
        $this->post("/ratings/{$book->id}")->assertStatus(403);
    }

    /**
     * @test
     */
    public function user_can_rate_only_issued_book()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create([
            'course_id' => Course::factory()->create()->id
        ]);

        $this->actingAs($user);

        $book->issue_logs()->create(['user_id' => $user->id, 'admin_id' => Admin::factory()->create()->id]);

        $this->post("/ratings/{$book->id}", ['score' => 1, 'message' => "123", 'user_id' => $user->id, 'book_id' => $book->id])->assertRedirect("/books/".$book->id);
    }

    /**
     * @test
     */
    public function user_can_add_only_one_rating_for_books()
    {
        $book = Book::factory()->create();
        $user = User::factory()->create([
            'course_id' => Course::factory()->create()->id
        ]);

        $this->actingAs($user);

        $book->issue_logs()->create(['user_id' => $user->id, 'admin_id' => Admin::factory()->create()->id]);

        $this->post("/ratings/{$book->id}", ['score' => 1, 'message' => "123", 'user_id' => $user->id, 'book_id' => $book->id])->assertRedirect("/books/".$book->id);
        $this->post("/ratings/{$book->id}", ['score' => 1, 'message' => "123", 'user_id' => $user->id, 'book_id' => $book->id])->assertStatus(403);
    }
}
