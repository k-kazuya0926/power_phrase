@extends('layouts.app')

@section('power_phrase', 'Edit Entry')

@section('content')
<div class="uk-container uk-container-xsmall">
    <form method="post" action="{{ url('/entries', $entry->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="uk-child-width-1-1" uk-grid>
            <div>
                <h4>{{ __('Power Phrase') }}</h4>
                <input class="uk-width-1-1" type="text" name="power_phrase" placeholder="" value="{{ old('power_phrase', $entry->power_phrase) }}" required>
                @if ($errors->has('power_phrase'))
                <span class="error">{{ $errors->first('power_phrase') }}</span>
                @endif
            </div>
            <div>
                <h4>{{ __('Source') }}</h4>
                <input class="uk-width-1-1" type="text" name="source" placeholder="" value="{{ old('source', $entry->source) }}">
                @if ($errors->has('source'))
                <span class="error">{{ $errors->first('source') }}</span>
                @endif
            </div>
            <div>
                <h4>{{ __('Episode') }}</h4>
                <textarea class="uk-width-1-1" name="episode" rows="5" placeholder="">{{ old('episode', $entry->episode) }}</textarea>
                @if ($errors->has('episode'))
                <span class="error">{{ $errors->first('episode') }}</span>
                @endif
            </div>
        </div>
        <p>
            <input type="submit" value="{{ __('Edit') }}">
            <a href="{{ url('/') }}" class="btn btn-link">{{ __('Back') }}</a>
        </p>
    </form>
</div>
@endsection