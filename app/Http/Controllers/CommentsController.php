<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, Entry $entry) {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment = new Comment(['comment' => $request->comment]);
        $entry->comments()->save($comment);
        return redirect()->action('EntriesController@show', $entry);
    }

    public function destroy(Entry $entry, Comment $comment) {
        $comment->delete();
        return redirect()->back();
    }
}
