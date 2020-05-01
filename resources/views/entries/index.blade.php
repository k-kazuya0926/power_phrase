@extends('layouts.default')

@section('title', 'Entries')

@section('content')
<h1>
    <a href="{{ url('/entries/create') }}" class="header-menu">New Entry</a>
    パワーフレーズ
</h1>
<ul>
    @forelse ($entries as $entry)
    <li>
        <a href="{{ action('EntriesController@show', $entry) }}">{{ $entry->power_phrase }}</a>
        <a href="{{ action('EntriesController@edit', $entry) }}" class="edit">[Edit]</a>
        <a href="#" class="del" data-id="{{ $entry->id }}">[x]</a>
        <form method="post" action="{{ url('/entries', $entry->id) }}" id="form_{{ $entry->id }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
        </form>
    </li>
    @empty
    <li>No entries yet</li>
    @endforelse
</ul>
<div class="d-flex justify-content-center">
    {{ $entries->links() }}
</div>
<script src="/js/main.js"></script>
@endsection
