@extends('layouts.app')

@section('title', 'Entries')

@section('content')
<div class="container">
    <h1 class="text-center">Power Phrase</h1>
    <p class="text-center">あなたを支える言葉を共有しよう！</p>
    <img class="img-fluid mx-auto d-block mb-5" src="images/3192174_s.jpg" alt="">
    <h3 class="text-center mb-3">投稿一覧</h3>
    <div class="card-deck">
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
                                if (confirm('削除しますか？')) {
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
                        {{ __('Comment') }}{{ $entry->comments->count() }}件
                    </div>
                </div>
            </div>
        @empty
        <li>No entries yet</li>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{ $entries->links() }}
    </div>
</div>
@endsection
