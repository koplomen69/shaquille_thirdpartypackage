@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                    <div class="p-6 m-20 bg-white rounded shadow">
                        @if(isset($chart))
                            {!! $chart->container() !!}
                        @else
                            <p>No chart data available.</p>
                        @endif
                    </div>

                    @if(isset($chart))
                        <script src="{{ $chart->cdn() }}"></script>
                        {{ $chart->script() }}
                    @endif

        </div>
    </div>
@endsection
