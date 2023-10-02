@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <form action="{{ route('shops.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Shop Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Shop Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create Shop</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Home</a>

                <br><br>

                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
