<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);

    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        // Given we have an authenticated user
        //$user = factory('App\User')->create();
        $this->be(factory('App\User')->create());

        // and an existing thread
        $thread = factory('App\Thread')->create();

        // when the user adds a reply to the thread
        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies', $reply->toArray());

        // then their reply should be visible on the page
        $this->get($thread->path())->assertSee($reply->body);
    }
}
