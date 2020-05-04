<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Entry;
use App\Http\Requests\EntryRequest;

class EntriesController extends Controller
{
    public function index() {
        $pagenation_count = 9;
        $entries = Entry::orderBy('created_at', 'desc')->paginate($pagenation_count);
        return view('entries.index')->with('entries', $entries);
    }

    public function show(Entry $entry) {
        return view('entries.show')->with('entry', $entry);
    }

    public function create() {
        return view('entries.create');
    }

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

    public function edit(Entry $entry) {
        return view('entries.edit')->with('entry', $entry);
    }

    public function update(EntryRequest $request, Entry $entry) {
        DB::transaction(function() use ($request, $entry) {
            $entry->power_phrase = $request->power_phrase;
            $entry->source = empty($request->source) ? '' : $request->source;
            $entry->episode = empty($request->episode) ? '' : $request->episode;
            $entry->save();
        });
        return redirect('/');
    }

    public function destroy(Entry $entry) {
        $entry->delete();
        return redirect('/');
    }
}
