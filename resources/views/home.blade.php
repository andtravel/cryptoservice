@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <h1>Home</h1>
                        @foreach($chartData as $key => $value)
                            <div class="container m-auto">
                                <div class="row">
                                    <div class="col-12">
                                        <h1>{{ $key }}</h1>
                                        <canvas id="{{ $key }}"></canvas>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
