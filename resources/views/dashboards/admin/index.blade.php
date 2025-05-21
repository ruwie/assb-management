@extends('layouts.admin')

@section('content')
    <h2>Welcome, Admin</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        
    </form>
@endsection