<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Like;
use Auth;
use App\Entry;

class LikesController extends Controller
{
    /**
     * いいね登録処理
     *
     * @param Request $request
     * @param Entry $entry
     * @return void
     */
    public function store(Request $request, Entry $entry)
    {
      $like = new Like();
      $like->user_id = Auth::user()->id;
      $like->entry_id = $entry->id;
      $like->save();

      return redirect()
            ->action('EntriesController@index');
    }

    /**
     * いいね削除処理
     *
     * @param Entry $entry
     * @param Like $like
     * @return void
     */
    public function destroy(Entry $entry, Like $like) {
      $like->delete();

      return redirect()
             ->action('EntriesController@index');
    }
}
