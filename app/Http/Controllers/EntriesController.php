<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Entry;
use App\Http\Requests\EntryRequest;

class EntriesController extends Controller
{
    const PAGENATION_COUNT = 9;

    /**
     * 投稿一覧画面表示
     */
    public function index(Request $request) {
        $query = \App\Entry::query();

        $keyword = $request->input('keyword');        
        if(!empty($keyword))
        {
            $query
                ->where('power_phrase', 'like', '%'.$keyword.'%')
                ->orWhere('source', 'like', '%'.$keyword.'%')
                ->orWhere('episode', 'like', '%'.$keyword.'%');
        }
        
        $entries = $query->orderBy('id','desc')->paginate(self::PAGENATION_COUNT);
        return view('entries.index')->with('entries', $entries)->with('keyword', $keyword);
    }

    /**
     * 投稿詳細画面表示
     */
    public function show(Entry $entry) {
        return view('entries.show')->with('entry', $entry);
    }

    /**
     * 投稿画面表示
     */
    public function create() {
        return view('entries.create');
    }

    /**
     * 投稿登録処理
     */
    public function store(EntryRequest $request) {
        $entry = new Entry();
        $entry->power_phrase = $request->power_phrase;
        $entry->source = empty($request->source) ? '' : $request->source;
        $entry->episode = empty($request->episode) ? '' : $request->episode;
        $entry->user_id = Auth::id();
        $entry->save();

        // $request->photo->store('public/profile_images'); // /storage/appからの相対パス

        return redirect('/');
    }

    /**
     * 投稿更新画面表示
     */
    public function edit(Entry $entry) {
        return view('entries.edit')->with('entry', $entry);
    }

    /**
     * 投稿更新処理
     */
    public function update(EntryRequest $request, Entry $entry) {
        DB::transaction(function() use ($request, $entry) {
            $entry->power_phrase = $request->power_phrase;
            $entry->source = empty($request->source) ? '' : $request->source;
            $entry->episode = empty($request->episode) ? '' : $request->episode;
            $entry->save();
        });
        return redirect('/');
    }

    /**
     * 投稿削除処理
     */
    public function destroy(Entry $entry) {
        $entry->delete();
        return redirect('/');
    }
}
