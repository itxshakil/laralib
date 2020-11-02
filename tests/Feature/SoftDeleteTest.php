<?php

namespace Tests\Feature;

use App\Admin;
use App\Book;
use App\Course;
use App\Rating;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SoftDeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function admin_can_soft_delete_users()
    {
        $user = User::factory()->create(['course_id' => Course::factory()->create()->id]);
        $this->actingAs(Admin::factory()->create(), 'admin');
        $this->delete(route('admin.users.destroy', $user))->assertOk();

        $this->assertSoftDeleted($user);
    }

    /**
     * @test
     */
    public function admin_can_soft_delete_rating()
    {
        $rating = Rating::factory()->create([
            'user_id' => User::factory()->create(['course_id' => Course::factory()->create()->id])->id,
            'book_id' => Book::factory()->create()->id
        ]);
        $this->actingAs(Admin::factory()->create(), 'admin');
        $this->delete(route('admin.ratings.destroy', $rating))->assertOk();

        $this->assertSoftDeleted($rating);
    }

    /**
     * @test
     */
    public function admin_can_soft_delete_book()
    {
        $book = Book::factory()->create();

        $this->actingAs(Admin::factory()->create(), 'admin');
        $this->delete(route('admin.books.destroy', $book))->assertOk();

        $this->assertSoftDeleted($book);
    }
}
