@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Service Providers Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Welcome!') }} <br> <br>

                        <div>
                            <a href="{{ route('services.create') }}" class="btn btn-primary d-inline ml-5">Add Services</a>

                        </div>
                    </div>
                </div>

                <br>
                <div class="card">
                    <div class="card-header">{{ __('Services List') }}</div>
                    <div class="card-body">
                        @if ($services->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->price }}</td>
                                            <td>
                                                <img src="{{ asset('images/' . $service->image_path) }}"
                                                    alt="{{ $service->name }}" width="100" height="100">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No Services Available</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
