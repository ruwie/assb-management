@extends('layouts.pwd')

@section('content')
    <h2>Welcome, PWD</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        
    </form>
@endsection