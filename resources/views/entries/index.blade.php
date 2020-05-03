@extends('layouts.app')

@section('title', 'Entries')

@section('content')
<div class="uk-container">
    <h2 class="uk-text-center uk-heading-divider">心に残っている言葉と<br>エピソードを共有しよう！</h2>
    <h3 class="uk-text-center">投稿一覧</h3>
    <div class="uk-child-width-1-1@s uk-child-width-1-3@s uk-grid-match" uk-grid>
        @forelse ($entries as $entry)
            <div>
                <div class="uk-card uk-card-default uk-card-default">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom">
                                    <a href="{{ action('EntriesController@show', $entry) }}">
                                        {{ $entry->power_phrase }}
                                        @if (!empty($entry->source))({{ $entry->source }})@endif</a>
                                </h3>
                                <span class="uk-text-meta uk-margin-remove-top">{{ $entry->user->name }} <time datetime="2016-04-01T19:00">2020/05/03</time></span>
                                @if ($entry->user_id == Auth::id())
                                <a href="{{ action('EntriesController@edit', $entry) }}" class="edit">[Edit]</a>
                                <a href="#" class="del" data-id="{{ $entry->id }}">[x]</a>
                                <form method="post" action="{{ url('/entries', $entry->id) }}" id="form_{{ $entry->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        {{ $entry->episode }}
                    </div>
                    <div class="uk-card-footer">
                        コメント1件　いいね！1件
                    </div>
                </div>
            </div>
        @empty
        <li>No entries yet</li>
        @endforelse
    </div>
    <div class="d-flex justify-content-center uk-margin-top">
        {{ $entries->links() }}
    </div>
</div>
<script src="/js/main.js"></script>
@endsection
