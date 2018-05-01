<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function test_a_user_can_view_all_threads()
    {

        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);

        //$response->assertStatus(200);

    }

    public function test_a_user_can_read_a_single_thread()
    {

        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->title);

    }

    public function test_a_user_can_read_replies_that_are_associeted_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path());
        $response->assertSee($reply->body);

    }
}
