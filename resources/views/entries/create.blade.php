@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Entry') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/entries') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="power_phrase" class="col-md-4 col-form-label text-md-right">{{ __('Register') }}</label>

                            <div class="col-md-6">
                                <input id="power_phrase" type="text" class="form-control @error('power_phrase') is-invalid @enderror" name="power_phrase" value="{{ old('power_phrase') }}" required autocomplete="power_phrase" autofocus>

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
                                <input id="source" type="text" class="form-control @error('source') is-invalid @enderror" name="source" value="{{ old('source') }}" required autocomplete="source">

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
                                <textarea id="episode" class="form-control @error('episode') is-invalid @enderror" name="episode" required autocomplete="episode">
                                    {{ old('episode') }}
                                </textarea>

                                @error('episode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- TODO 画像アップロード --}}
                        {{-- <p>
                            <input type="file" name="photo">
                        </p> --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ url('/') }}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
