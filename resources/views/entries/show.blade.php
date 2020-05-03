@extends('layouts.app')

@section('title', $entry->power_phrase)

@section('content')
<div class="uk-container uk-container-xsmall">
    {{-- <h1>
        <a href="{{ url('/') }}" class="header-menu">Back</a>
        {{ $entry->power_phrase }}
    </h1>
    <p>{!! nl2br(e($entry->source)) !!}</p>
    <p>{!! nl2br(e($entry->episode)) !!}</p> --}}
    {{-- <figure>
        <img src="/storage/profile_images/pjV4h8aJvgPUa3RSgICzR51SDdRhb53XupYT0RjK.png" width="100px" height="100px">
        <figcaption>画像</figcaption>
    </figure> --}}

    <div class="uk-child-width-1-1" uk-grid>
        <div>
            <h4>パワーフレーズ</h4>
            <p>{{ $entry->power_phrase }}</p>
        </div>
        <div>
            <h4>出所</h4>
            <p>{!! nl2br(e($entry->source)) !!}</p>
        </div>
        <div>
            <h4>エピソード</h4>
            <p>{!! nl2br(e($entry->episode)) !!}</p>
        </div>
    </div>

    {{-- <h2>Comments</h2>
    <ul>
        @forelse ($entry->comments as $comment)
        <li>
            {{ $comment->body }}
            <a href="#" class="del" data-id="{{ $comment->id }}">[x]</a>
            <form method="entry" action="{{ action('CommentsController@destroy', [$entry, $comment]) }}" id="form_{{ $comment->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            </form>
        </li>
        @empty
        <li>No comments yet</li>
        @endforelse
    </ul>
    <form method="entry" action="{{ action('CommentsController@store', $entry) }}">
        {{ csrf_field() }}
        <p>
            <input type="text" name="body" placeholder="enter comment" value="{{ old('body') }}">
            @if ($errors->has('body'))
            <span class="error">{{ $errors->first('body') }}</span>
            @endif
        </p>
        <p>
            <input type="submit" value="Add Comment">
        </p>
    </form> --}}
    <a href="{{ url('/') }}" class="btn btn-link uk-margin-top">戻る</a>
</div>
<script src="/js/main.js"></script>
@endsection