<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entry;
use App\Http\Requests\EntryRequest;

class EntriesController extends Controller
{
    public function index() {
        $entries = Entry::orderBy('created_at', 'desc')->paginate(10);
        return view('entries.index')->with('entries', $entries);
    }

    public function show(Entry $entry) {
        return view('entries.show')->with('entry', $entry);
    }

    public function create() {
        // TODO
        // if (!Auth::check()) {
        //     return view('auth/login');
        // }
        return view('entries.create');
    }

    public function store(EntryRequest $request) {
        $entry = new Entry();
        $entry->power_phrase = $request->power_phrase;
        $entry->source = $request->source;
        if (!empty($request->episode)) {
            $entry->episode = $request->episode;
        }
        $entry->save();

        // $request->photo->store('public/profile_images'); // /storage/appからの相対パス

        return redirect('/');
    }

    public function edit(Entry $entry) {
        if (!Auth::check()) {
            return view('auth/login');
        }
        return view('entries.edit')->with('entry', $entry);
    }

    public function update(EntryRequest $request, Entry $entry) {
        $entry->power_phrase = $request->power_phrase;
        $entry->source = $request->source;
        if (!empty($request->episode)) {
            $entry->episode = $request->episode;
        }
        $entry->save();
        return redirect('/');
    }

    public function destroy(Entry $entry) {
        $entry->delete();
        return redirect('/');
    }
}
