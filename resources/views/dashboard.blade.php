@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to your Dashboard</h1>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
@endsection
