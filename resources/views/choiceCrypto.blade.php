@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Choice crypto') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Choose crypto for watching') }}
                        <form action="{{ route('cryptos') }}" method="post">
                            @csrf
                            @foreach($cryptos as $crypto)
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="{{ $crypto->id }}"
                                           id="flexSwitchCheckDefault">
                                    <label class="form-check-label"
                                           for="flexSwitchCheckDefault">{{ $crypto->name }}</label>
                                </div>
                            @endforeach
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

