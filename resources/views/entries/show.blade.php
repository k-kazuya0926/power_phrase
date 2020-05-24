@extends('layouts.app')

@section('title', $entry->power_phrase)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Entry') }}{{ __('Detail') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ action('CommentsController@store', $entry) }}">
                        @csrf

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
                                    <p>{!! nl2br(e($comment->comment)) !!}</p>
                                    {{-- <a href="#" class="del" data-id="{{ $comment->id }}">[x]</a>
                                    <form method="entry" action="{{ action('CommentsController@destroy', [$entry, $comment]) }}" id="form_{{ $comment->id }}">
                                        @csrf
                                        {{ method_field('delete') }}
                                    </form> --}}
                                </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>

                        @auth
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
                        @endauth

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ url('/') }}" class="btn btn-link">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection