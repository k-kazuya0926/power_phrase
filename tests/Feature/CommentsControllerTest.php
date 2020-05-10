<?php

namespace Tests\Feature;

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
        $response = $this->post(
            '/posts/1/comments',
            ['comment' => 'テストコメント']
        );

        $response
            ->assertRedirect('/entries/1');
    }
}
