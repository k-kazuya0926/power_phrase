@extends('layouts.app')

@section('title', 'Entries')

@section('content')
<div class="container">
    <h1 class="text-center">Power Phrase</h1>
    <p class="text-center">あなたを支える言葉を共有しよう！</p>
    <img class="img-fluid mx-auto d-block mb-5" src="images/3192174_s.jpg" alt="">
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
                        </h4>
                        <h5>@if (!empty($entry->source)){{ $entry->source }}@endif</h5>
                        <p>{{ $entry->episode }}</p>
                    </div>
                    <div class="card-footer">
                        <div>
                            {{ $entry->user->name }}
                            @if ($entry->user_id == Auth::id())
                            <a href="{{ action('EntriesController@edit', $entry) }}" class="edit">[{{ __('Edit') }}]</a>
                            <a href="#" class="del" data-id="{{ $entry->id }}" onclick="
                                event.preventDefault();
                                if (confirm('{{ __('Delete') }}しますか？')) {
                                    document.getElementById('form_{{ $entry->id }}').submit();
                                }    
                            ">
                                [{{ __('Delete') }}]
                            </a>
                            <form method="post" action="{{ url('/entries', $entry->id) }}" id="form_{{ $entry->id }}">
                                @csrf
                                {{ method_field('delete') }}
                            </form>
                            @endif
                        </div>
                        <div>{{ $entry->created_at }}</div>
                        {{ __('Comment') }}{{ $entry->comments->count() }}件　いいね！{{ $entry->likes_count }}件
                        @if (Auth::check()) {{-- ログイン済みである場合 --}}
                            @php
                                $like = $entry->likes()->where('user_id', Auth::user()->id)->first();
                            @endphp
                            @if ($like) {{-- いいね押下済である場合 --}}
                            {{ Form::model($entry, array('action' => array('LikesController@destroy', $entry->id, $like->id))) }}
                                <button type="submit">
                                {{-- <img src="/images/icon_heart_red.svg"> --}}
                                {{ __('Like') }}解除
                                </button>
                            {!! Form::close() !!}
                            @else {{-- いいね未押下である場合 --}}
                            {{ Form::model($entry, array('action' => array('LikesController@store', $entry->id))) }}
                                <button type="submit">
                                {{-- <img src="/images/icon_heart.svg"> --}}
                                {{ __('Like') }}
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
