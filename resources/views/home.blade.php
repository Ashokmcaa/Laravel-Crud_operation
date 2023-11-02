@extends('layouts.app')

@section('content')

@if(Auth::user()->admin == 0)
@php
    $productId = 123;
    $productPageUrl = '/product';
    header("Location: $productPageUrl");
    exit;
@endphp
@endif


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
            </div>
        </div>
    </div>
</div>
@endsection
