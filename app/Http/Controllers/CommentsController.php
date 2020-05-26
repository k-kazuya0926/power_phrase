<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Entry;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * コメント登録処理
     * 
     */
    public function store(Request $request, Entry $entry) {
        DB::transaction(function() use ($request, $entry) {
            $this->validate($request, Comment::$rules);
            $comment = new Comment();
            $comment->entry_id = $entry->id;
            $comment->comment = $request->comment;
            $comment->user_id = Auth::id();
            $comment->save();
        });

        return redirect()->action('EntriesController@show', $entry);
    }

    /**
     * コメント削除処理
     */
    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect()->action('EntriesController@show', $comment->entry);
    }
}
