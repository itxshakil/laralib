<?php

namespace Tests\Unit;

use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function new_tag_can_be_created()
    {
        $tag = Tag::factory()->make();
        Tag::create($tag->toArray());

        $this->assertDatabaseHas('tags', ['name' => $tag->name]);
    }
}
