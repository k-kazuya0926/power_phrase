<?php

namespace Tests\Feature;

use App\Entry;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntriesControllerTest extends TestCase
{
    use RefreshDatabase;

    const USER_ID = 1;
    const ENTRY_ID = 1;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'id' => self::USER_ID
        ]);
        factory(Entry::class)->create([
            'id' => self::ENTRY_ID,
            'power_phrase' => 'テストフレーズ',
            'source' => 'テストソース',
            'episode' => 'テストエピソード',
            'user_id' => 1
        ]);
    }

    /**
     * @test
     */
    public function index_トップページ_未ログイン()
    {
        $response = $this->get('/');

        $this->assertIndexCommon($response);
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
        $response = $this->actingAs($this->user)->get('/');

        $this->assertIndexCommon($response);
        $response
            ->assertSee('投稿する')
            ->assertSee('マイページ')
            ->assertSee('ログアウト');
    }

    /**
     * トップページ共通内容テスト
     */
    private function assertIndexCommon($response)
    {
        $response
            ->assertStatus(200)
            ->assertViewIs('entries.index') // viewファイル
            ->assertSee('Power Phrase')
            ->assertSee('投稿一覧')
            ->assertSee('検索');
    }

    /**
     * @test
     */
    public function show_投稿詳細画面表示()
    {
        $response = $this->get('/entries/' . self::ENTRY_ID);

        $response
            ->assertStatus(200)
            ->assertSee('投稿詳細')
            ->assertSee('パワーフレーズ')
            ->assertSee('テストフレーズ')
            ->assertSee('どこで知りましたか？')
            ->assertSee('テストソース')
            ->assertSee('エピソード')
            ->assertSee('テストエピソード')
            ->assertSee('コメント')
            ->assertSee('トップページへ戻る');
    }

    /**
     * @test
     */
    public function create_投稿登録画面表示()
    {
        $response = $this->actingAs($this->user)->get('/entries/create');

        $response
            ->assertStatus(200)
            ->assertSee('パワーフレーズ')
            ->assertSee('どこで知りましたか？')
            ->assertSee('例：本のタイトル、WebサイトのURL、友人からなど')
            ->assertSee('エピソード')
            ->assertSee('投稿')
            ->assertSee('トップページへ戻る');
    }

    /**
     * @test
     */
    public function store_投稿登録処理()
    {
        $power_phrase = '投稿登録処理テスト';
        $response = $this->actingAs($this->user)->post(
            '/entries',
            [
                'power_phrase' => $power_phrase,
                'source' => '友人',
                'episode' => 'テスト'
            ]
        );

        $response
            ->assertRedirect('/');
        $this->assertDatabaseHas('entries', [
            'power_phrase' => $power_phrase
        ]);
    }
    
    /**
     * @test
     */
    public function edit_投稿更新画面表示()
    {
        $response = $this->actingAs($this->user)->get('/entries/' . self::ENTRY_ID . '/edit');

        $response
            ->assertStatus(200)
            ->assertSee('パワーフレーズ')
            ->assertSee('どこで知りましたか？')
            ->assertSee('エピソード')
            ->assertSee('更新')
            ->assertSee('トップページへ戻る');
    }

    /**
     * @test
     */
    public function update_投稿更新処理()
    {
        $power_phrase = '投稿更新処理テスト';
        $response = $this->actingAs($this->user)->patch(
            '/entries/' . self::ENTRY_ID,
            [
                'power_phrase' => $power_phrase,
                'source' => '友人',
                'episode' => 'テスト'
            ]
        );

        $response
            ->assertRedirect('/');
        $this->assertDatabaseHas('entries', [
            'power_phrase' => $power_phrase
        ]);
    }

    /**
     * @test
     */
    public function destroy_投稿削除処理()
    {
        $response = $this->actingAs($this->user)->delete('/entries/' . self::ENTRY_ID);

        $response
            ->assertRedirect('/');
        $this->assertSoftDeleted('entries', [
            'id' => self::ENTRY_ID,
        ]);
    }
}
