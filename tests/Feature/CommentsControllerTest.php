<?php

namespace Tests\Feature;

use App\Entry;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentsControllerTest extends TestCase
{
    use RefreshDatabase;

    const USER_ID = 1;
    const ENTRY_ID = 1;
    private $user;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'id' => self::USER_ID
        ]);
        factory(Entry::class)->create([
            'id' => self::ENTRY_ID
        ]);
    }

    /**
     * @test
     */
    public function store_コメント登録処理()
    {
        $comment = 'テストコメント';
        $response = $this->actingAs($this->user)->post(
            '/entries/' . self::ENTRY_ID . '/comments',
            ['comment' => $comment]
        );

        $response->assertRedirect('/entries/' . self::ENTRY_ID);

        $this->assertDatabaseHas('comments', [
            'entry_id' => self::ENTRY_ID,
            'user_id' => self::USER_ID,
            'comment' => $comment
        ]);
    }

    /**
     * @test
     */
    public function store_コメント空()
    {
        $comment = null;
        $response = $this->actingAs($this->user)->post(
            '/entries/' . self::ENTRY_ID . '/comments',
            ['comment' => $comment]
        );
        
        // TODO なぜ「/」？
        // $response->assertRedirect('/entries/' . self::ENTRY_ID);
        $response->assertRedirect('/');

        $this->assertDatabaseMissing('comments', [
            'entry_id' => self::ENTRY_ID,
            'user_id' => self::USER_ID,
        ]);
    }
}
