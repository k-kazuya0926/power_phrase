<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Like;
use Auth;
use App\Entry;

class LikesController extends Controller
{
    public function store(Request $request, $entryId)
    {
        Like::create(
          array(
            'user_id' => Auth::user()->id,
            'entry_id' => $entryId
          )
        );

        $entry = Entry::findOrFail($entryId);

        return redirect()
             ->action('EntriesController@index');
    }

    public function destroy($entryId, $likeId) {
      $entry = Entry::findOrFail($entryId);
      $entry->like_by()->findOrFail($likeId)->delete();

      return redirect()
             ->action('EntriesController@index');
    }
}
