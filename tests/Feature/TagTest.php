<?php

namespace Tests\Feature;

use App\Tag;
use App\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticated_admin_can_create_new_tags()
    {
        $this->actingAs(factory(Admin::class)->create(), 'admin');
        $tag = factory(Tag::class)->make();
        $this->post(route('admin.tags.store'), $tag->toArray())->assertCreated();
        $this->post(route('admin.tags.store'), $tag->toArray())->assertOk();

        $this->assertDatabaseCount('tags', 1);
    }

    /**
     * @test
     */
    public function unauthenticated_admin_cannot_create_new_tags()
    {
        $tag = factory(Tag::class)->make();
        $this->post(route('admin.tags.store'), $tag->toArray())->assertRedirect('/admin/login');
    }
}
