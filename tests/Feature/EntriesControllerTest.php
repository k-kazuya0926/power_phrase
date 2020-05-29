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
        $response
            ->assertSee('おためしログイン')
            ->assertSee('ログイン')
            ->assertSee('ユーザー登録');
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
        $response
            ->assertSee('投稿する')
            ->assertSee('マイページ')
            ->assertSee('ログアウト');
    }

    /**
     * トップページ共通内容テスト
     */
    private function assertTestIndexCommon($response)
    {
        $response
            ->assertStatus(200)
            ->assertViewIs('entries.index') // // viewファイル
            ->assertSee('Power Phrase')
            ->assertSee('投稿一覧')
            ->assertSee('検索');
    }

    /**
     * 投稿詳細画面表示テスト
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/entries/1');

        $response
            ->assertStatus(200)
            ->assertSee('投稿詳細')
            ->assertSee('パワーフレーズ')
            ->assertSee('どこで知りましたか？')
            ->assertSee('エピソード')
            ->assertSee('コメント')
            ->assertSee('戻る');
    }

    /**
     * 投稿画面表示テスト
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get('/entries/create');

        $response
            ->assertStatus(200)
            ->assertSee('パワーフレーズ')
            ->assertSee('どこで知りましたか？')
            ->assertSee('エピソード')
            ->assertSee('投稿')
            ->assertSee('戻る');
    }

    /**
     * 投稿登録処理テスト
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post(
            '/entries',
            [
                'power_phrase' => 'テストフレーズ',
                'source' => '友人',
                'episode' => 'テスト'
            ]
        );

        $response
            ->assertRedirect('/');
    }
    
    /**
     * 投稿更新画面表示テスト
     *
     * @return void
     */
    public function testEdit()
    {
        $response = $this->get('/entries/1/edit');

        $response
            ->assertStatus(200)
            ->assertSee('パワーフレーズ')
            ->assertSee('どこで知りましたか？')
            ->assertSee('エピソード')
            ->assertSee('更新')
            ->assertSee('戻る');
    }

    /**
     * 投稿更新処理テスト
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->patch(
            '/entries/1',
            [
                'power_phrase' => 'テストフレーズ',
                'source' => '友人',
                'episode' => 'テスト'
            ]
        );

        $response
            ->assertRedirect('/');
    }

    /**
     * 投稿削除処理テスト
     *
     * @return void
     */
    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->delete('/entries/1');

        $response
            ->assertRedirect('/');
    }
}
