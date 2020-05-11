@extends('layouts.app')

@section('power_phrase', 'Edit Entry')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Entry') }}{{ __('Edit') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ url('/entries', $entry->id) }}">
                        @csrf
                        {{ method_field('patch') }}

                        <div class="form-group row">
                            <label for="power_phrase" class="col-md-4 col-form-label text-md-right">{{ __('Power Phrase') }}</label>

                            <div class="col-md-6">
                                <input id="power_phrase" type="text" class="form-control @error('power_phrase') is-invalid @enderror" name="power_phrase" value="{{ old('power_phrase', $entry->power_phrase) }}" required autocomplete="power_phrase" autofocus>

                                @error('power_phrase')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="source" class="col-md-4 col-form-label text-md-right">{{ __('Source') }}</label>

                            <div class="col-md-6">
                                <input id="source" type="source" class="form-control @error('source') is-invalid @enderror" name="source" value="{{ old('source', $entry->source) }}" autocomplete="source">
                                例：本のタイトル、WebサイトのURL、友人からなど

                                @error('source')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="episode" class="col-md-4 col-form-label text-md-right">{{ __('Episode') }}</label>

                            <div class="col-md-6">
                                <textarea id="episode" type="episode" class="form-control @error('episode') is-invalid @enderror" name="episode" rows="5">{{ old('episode', $entry->episode) }}</textarea>

                                @error('episode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
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