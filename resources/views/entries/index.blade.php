@extends('layouts.app')

@section('title', 'Entries')

@section('content')
<div class="container">
    <h1 class="text-center">Power Phrase</h1>
    <p class="text-center">あなたを支える言葉を共有しよう！</p>
    <img class="img-fluid mx-auto d-block mb-5" src="/images/3192174_s.jpg" alt="" width="400px" height="300px">
    <h3 class="text-center mb-3">投稿一覧</h3>
    <form method="get" action="{{ url('/') }}" class="form-inline justify-content-center">
        @csrf
        <div class="form-group">
            <input type="text" name="keyword" class="form-control" value="{{$keyword}}" placeholder="検索キーワード">
        </div>
        <input type="submit" value="検索" class="btn btn-info">
    </form>
    <div class="card-deck mt-3">
        @forelse ($entries as $entry)
            <div class="col-sm-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ action('EntriesController@show', $entry) }}">
                                {{ $entry->power_phrase }}
                            </a>
                            @if ($entry->user_id == Auth::id())
                            <a href="{{ action('EntriesController@edit', $entry) }}" class="edit">
                                <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                            <a href="#" class="del" data-id="{{ $entry->id }}" onclick="
                                event.preventDefault();
                                if (confirm('{{ __('Delete') }}しますか？')) {
                                    document.getElementById('form_{{ $entry->id }}').submit();
                                }    
                            ">
                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                            <form method="post" action="{{ url('/entries', $entry->id) }}" id="form_{{ $entry->id }}">
                                @csrf
                                {{ method_field('delete') }}
                            </form>
                            @endif
                        </h4>
                        <h5>@if (!empty($entry->source)){{ $entry->source }}@endif</h5>
                        <p>{{ $entry->episode }}</p>
                    </div>
                    <div class="card-footer">
                        <div>
                            @if (!empty($entry->user->image_filename))
                            <img src="/storage/profile_images/{{ $entry->user->image_filename }}" width="35px" height="35px" class="rounded-circle">
                            @endif
                            <a href="{{ action('UsersController@show', $entry->user) }}">{{ $entry->user->name }}</a>
                        </div>
                        <div>{{ $entry->created_at }}</div>
                        {{ __('Comment') }}{{ $entry->comments->count() }}件　いいね！{{ $entry->likes_count }}件
                        @if (Auth::check()) {{-- ログイン済みである場合 --}}
                            @php
                                $like = $entry->likes()->where('user_id', Auth::user()->id)->first();
                            @endphp
                            @if ($like) {{-- いいね押下済である場合 --}}
                            {{ Form::model($entry, array('action' => array('LikesController@destroy', $entry, $like))) }}
                                <button type="submit">
                                    <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            {!! Form::close() !!}
                            @else {{-- いいね未押下である場合 --}}
                            {{ Form::model($entry, array('action' => array('LikesController@store', $entry))) }}
                                <button type="submit">
                                    <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 01.176-.17C12.72-3.042 23.333 4.867 8 15z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            {!! Form::close() !!}
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @empty
        <div class="col-12 text-center">投稿はありません。</div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{ $entries->appends(['keyword'=>$keyword])->links() }}
    </div>
</div>
@endsection
