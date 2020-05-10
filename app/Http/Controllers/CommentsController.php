<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $this->validate($request, [
                'comment' => 'required'
            ]);
            $comment = new Comment(['comment' => $request->comment]);
            $entry->comments()->save($comment);
        });
        return redirect()->action('EntriesController@show', $entry);
    }
}
