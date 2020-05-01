@extends('layouts.default')

@section('power_phrase', 'Edit Entry')

@section('content')
<h1>
    <a href="{{ url('/') }}" class="header-menu">Back</a>
    Edit Entry
</h1>
<form method="post" action="{{ url('/entries', $entry->id) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <p>
        <input type="text" name="power_phrase" placeholder="enter power_phrase" value="{{ old('power_phrase', $entry->power_phrase) }}">
        @if ($errors->has('power_phrase'))
        <span class="error">{{ $errors->first('power_phrase') }}</span>
        @endif
    </p>
    <p>
        <input type="text" name="source" placeholder="enter source" value="{{ old('source', $entry->source) }}">
        @if ($errors->has('source'))
        <span class="error">{{ $errors->first('source') }}</span>
        @endif
    </p>
    <p>
        <textarea name="episode" placeholder="enter episode">{{ old('episode', $entry->episode) }}</textarea>
        @if ($errors->has('episode'))
        <span class="error">{{ $errors->first('episode') }}</span>
        @endif
    </p>
    <p>
        <input type="submit" value="Update">
    </p>
</form>
@endsection