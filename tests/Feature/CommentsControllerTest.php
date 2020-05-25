<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * コメント登録処理テスト
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post(
            '/entries/1/comments',
            ['comment' => 'テストコメント']
        );

        $response
            ->assertRedirect('/entries/1');
    }
}
