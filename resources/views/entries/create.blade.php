@extends('layouts.default')

@section('power_phrase', 'New Entry')

@section('content')
<h1>
    <a href="{{ url('/') }}" class="header-menu">Back</a>
    New Entry
</h1>
<form method="post" action="{{ url('/entries') }}">
{{-- <form method="post" action="{{ url('/entries') }}" enctype="multipart/form-data"> --}}
    {{ csrf_field() }}
    <p>
        <input type="text" name="power_phrase" placeholder="enter power_phrase" value="{{ old('power_phrase') }}">
        @if ($errors->has('power_phrase'))
        <span class="error">{{ $errors->first('power_phrase') }}</span>
        @endif
    </p>
    <p>
        <input type="text" name="source" placeholder="enter source" value="{{ old('source') }}">
        @if ($errors->has('source'))
        <span class="error">{{ $errors->first('source') }}</span>
        @endif
    </p>
    <p>
        <textarea name="episode" placeholder="enter episode">{{ old('episode') }}</textarea>
        @if ($errors->has('episode'))
        <span class="error">{{ $errors->first('episode') }}</span>
        @endif
    </p>
    {{-- <p>
        <input type="file" name="photo">
    </p> --}}
    <p>
        <input type="submit" value="Add">
    </p>
</form>
@endsection