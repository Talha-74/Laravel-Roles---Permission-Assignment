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

                        {{ __('You are logged in!') }} <br> <br>

                        <div>
                            <a href="{{ url('/shops/create') }}" class="btn btn-primary">Add Shop</a>
                            <a href="{{ route('shops.login') }}" class="btn btn-primary">Login as Shop</a>
                            <a href="{{ url('/serviceProviders/create') }}" class="btn btn-primary">Add Service Providers</a>
                            <a href="{{ route('serviceProviders.login') }}" class="btn btn-primary">Login as Service Providers</a>
                            <a href="{{ url('/display/shops') }}" class="btn btn-primary">Display</a>
                        </div>

                        <br><br>
                        <div class="card">
                            <div class="card-header">
                                Notifications
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach (auth()->user()->notifications as $notification)
                                        <li>{{ $notification->data['message'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
