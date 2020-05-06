<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntriesControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * トップページ表示テスト　未ログイン
     *
     * @return void
     */
    public function testIndex_beforeLogin()
    {
        $response = $this->get('/');

        $this->assertTestIndexCommon($response);
        $response->assertSee('ログイン');
    }

    /**
     * トップページ表示テスト　ログイン済み
     *
     * @return void
     */
    public function testIndex_afterLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/');

        $this->assertTestIndexCommon($response);
        $response->assertSee('投稿する');
    }

    /**
     * トップページ共通内容テスト
     */
    private function assertTestIndexCommon($response)
    {
        $response
            ->assertStatus(200)
            ->assertViewIs('entries.index')
            ->assertSee('Power Phrase');
    }
}
