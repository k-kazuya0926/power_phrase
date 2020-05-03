@extends('layouts.app')

@section('power_phrase', 'Edit Entry')

@section('content')
<div class="uk-container uk-container-xsmall">
    <form method="post" action="{{ url('/entries', $entry->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="uk-child-width-1-1" uk-grid>
            <div>
                <h4>パワーフレーズ</h4>
                <input class="uk-width-1-1" type="text" name="power_phrase" placeholder="enter power_phrase" value="{{ old('power_phrase', $entry->power_phrase) }}" required>
                @if ($errors->has('power_phrase'))
                <span class="error">{{ $errors->first('power_phrase') }}</span>
                @endif
            </div>
            <div>
                <h4>出所</h4>
                <input class="uk-width-1-1" type="text" name="source" placeholder="enter source" value="{{ old('source', $entry->source) }}">
                @if ($errors->has('source'))
                <span class="error">{{ $errors->first('source') }}</span>
                @endif
            </div>
            <div>
                <h4>エピソード</h4>
                <textarea class="uk-width-1-1" name="episode" rows="5" placeholder="enter episode">{{ old('episode', $entry->episode) }}</textarea>
                @if ($errors->has('episode'))
                <span class="error">{{ $errors->first('episode') }}</span>
                @endif
            </div>
        </div>
        <p>
            <input type="submit" value="更新">
            <a href="{{ url('/') }}" class="btn btn-link">戻る</a>
        </p>
    </form>
</div>
@endsection