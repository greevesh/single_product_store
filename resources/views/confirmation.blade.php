@extends('layouts.app')

@section('content')
    @if(session()->has('paymentSuccessMessage'))
        <h2 class="mt-5 alert alert-success text-center">{{ session()->get('paymentSuccessMessage') }}</h2>
        <h3 class="text-center"><a href="{{ route('landing') }}">Return Home</a></h3>
    @endif
@endsection 