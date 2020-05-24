@extends('layouts.app')

@section('title', $entry->power_phrase)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Entry') }}{{ __('Detail') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="power_phrase" class="col-md-4 text-md-right">{{ __('Power Phrase') }}</label>

                        <div class="col-md-6">
                            <span>{{ $entry->power_phrase }}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="source" class="col-md-4 text-md-right">{{ __('Source') }}</label>

                        <div class="col-md-6">
                            {!! nl2br(e($entry->source)) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="episode" class="col-md-4 text-md-right">{{ __('Episode') }}</label>

                        <div class="col-md-6">
                            {{ $entry->episode }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="comment" class="col-md-4 text-md-right">{{ __('Comment') }}</label>

                        <div class="col-md-6">
                            <ul>
                            @foreach ($entry->comments as $comment)
                            <li>
                                {{ $comment->created_at }}　{{ $comment->user->name }}
                                @if ($comment->user_id == Auth::id())
                                <a href="#" class="del" data-id="{{ $comment->id }}" onclick="
                                    event.preventDefault();
                                    if (confirm('{{ __('Delete') }}しますか？')) {
                                        document.getElementById('form_{{ $comment->id }}').submit();
                                    }    
                                ">
                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <form method="post" action="{{ url('/comments', $comment->id) }}" id="form_{{ $comment->id }}">
                                    @csrf
                                    {{ method_field('delete') }}
                                </form>
                                @endif

                                <p>{!! nl2br(e($comment->comment)) !!}</p>
                            </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>

                    @auth
                    <form method="post" action="{{ action('CommentsController@store', $entry) }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <textarea id="comment" type="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="5" required></textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button type="submit" class="btn btn-primary mt-3">
                                    {{ __('Comment') }}登録
                                </button>
                            </div>
                        </div>
                    </form>
                    @endauth

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ url('/') }}" class="btn btn-link">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection