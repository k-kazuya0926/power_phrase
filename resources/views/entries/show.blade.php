@extends('layouts.app')

@section('title', $entry->power_phrase)

@section('content')
<div class="uk-container uk-container-xsmall">
    <div class="uk-child-width-1-1" uk-grid>
        <div>
            <h2>{{ $entry->power_phrase }}</h2>
        </div>
        <div>
            <h4>{{ __('Source') }}</h4>
            <p>{!! nl2br(e($entry->source)) !!}</p>
        </div>
        <div>
            <h4>{{ __('Episode') }}</h4>
            <p>{!! nl2br(e($entry->episode)) !!}</p>
        </div>
    </div>

    <h3>{{ __('Comment') }}</h3>
    <ul>
        @foreach ($entry->comments as $comment)
        <li>
            {{ $comment->created_at }} {{ $comment->comment }}
            {{-- <a href="#" class="del" data-id="{{ $comment->id }}">[x]</a>
            <form method="entry" action="{{ action('CommentsController@destroy', [$entry, $comment]) }}" id="form_{{ $comment->id }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            </form> --}}
        </li>
        @endforeach
    </ul>
    <form method="post" action="{{ action('CommentsController@store', $entry) }}">
        {{ csrf_field() }}
        <p>
            <textarea class="uk-width-1-1" name="comment" rows="5" placeholder="" required>{{ old('comment') }}</textarea>
            @if ($errors->has('comment'))
            <span class="error">{{ $errors->first('comment') }}</span>
            @endif
        </p>
        <p>
            <input type="submit" value="{{ __('Comment') }}登録">
        </p>
    </form>
    <a href="{{ url('/') }}" class="btn btn-link uk-margin-top">{{ __('Back') }}</a>
</div>
<script src="/js/main.js"></script>
@endsection