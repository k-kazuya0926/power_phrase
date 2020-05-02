@extends('layouts.app')

@section('title', 'Entries')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>
                {{-- TODO ログイン済である場合のみ表示 --}}
                {{-- @auth --}}
                    <a href="{{ url('/entries/create') }}" class="header-menu">New Entry</a>
                {{-- @endauth --}}
                パワーフレーズ
            </h1>
            <ul>
                @forelse ($entries as $entry)
                <li>
                    <a href="{{ action('EntriesController@show', $entry) }}">ID：{{ $entry->id }} パワーフレーズ：{{ $entry->power_phrase }} ユーザーID：{{ $entry->user_id }}</a>

                    {{-- TODO 登録者=ログインユーザーである場合のみ表示 --}}
                    @auth
                        <a href="{{ action('EntriesController@edit', $entry) }}" class="edit">[Edit]</a>
                        <a href="#" class="del" data-id="{{ $entry->id }}">[x]</a>
                        <form method="post" action="{{ url('/entries', $entry->id) }}" id="form_{{ $entry->id }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                        </form>
                    @endauth
                </li>
                @empty
                <li>No entries yet</li>
                @endforelse
            </ul>
            <div class="d-flex justify-content-center">
                {{ $entries->links() }}
            </div>
        </div>
    </div>
</div>
<script src="/js/main.js"></script>
@endsection
