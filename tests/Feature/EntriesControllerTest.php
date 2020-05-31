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
     * @test
     */
    public function index_トップページ_未ログイン()
    {
        factory(User::class, 10)->create();

        $response = $this->get('/');

        $this->assertTestIndexCommon($response);
        $response
            ->assertSee('おためしログイン')
            ->assertSee('ログイン')
            ->assertSee('ユーザー登録');
    }

    /**
     * @test
     */
    public function index_トップページ_ログイン済み()
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
     * @test
     */
    public function show_投稿詳細画面表示()
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
     * @test
     */
    public function create_投稿登録画面表示()
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
     * @test
     */
    public function store_投稿登録処理()
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
     * @test
     */
    public function edit_投稿更新画面表示()
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
     * @test
     */
    public function update_投稿更新処理()
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
     * @test
     */
    public function destroy_投稿削除処理()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->delete('/entries/1');

        $response
            ->assertRedirect('/');
    }
}
