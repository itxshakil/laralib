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
        $user = factory(User::class)->create(['course_id' => factory(Course::class)->create()->id]);
        $this->actingAs(factory(Admin::class)->create(), 'admin');
        $this->delete(route('admin.users.destroy', $user))->assertOk();

        $this->assertSoftDeleted($user);
    }

    /**
     * @test
     */
    public function admin_can_soft_delete_rating()
    {
        $rating = factory(Rating::class)->create([
            'user_id' => factory(User::class)->create(['course_id' => factory(Course::class)->create()->id])->id,
            'book_id' => factory(Book::class)->create()->id
        ]);
        $this->actingAs(factory(Admin::class)->create(), 'admin');
        $this->delete(route('admin.ratings.destroy', $rating))->assertOk();

        $this->assertSoftDeleted($rating);
    }
}
