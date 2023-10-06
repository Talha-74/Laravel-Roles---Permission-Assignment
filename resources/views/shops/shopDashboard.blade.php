@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Shop Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Welcome!') }} <br> <br>

                        <div>
                            <a href="{{url('/shops/products/create')}}" class="btn btn-primary d-inline ml-5">Add Product</a>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Home</a>

                        </div>

                    </div>
                </div>
<br>
                <div class="card">
                    <div class="card-header">{{ __('Products List') }}</div>
                    <div class="card-body">
                        @if($products->count() > 0)
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
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            <img src="{{asset('images/' . $product->image_path)}}" alt="{{$product->name}}" width="100" height="100">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No Product Available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
