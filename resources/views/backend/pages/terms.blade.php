@extends('layouts.app')

@section('title', 'Terms Of Use')

@section('content')

<div class="container">
    <h5 class="border-bottom pb-3 fw-light mt-5 p-4">{{ $terms->title }}</h5>
    <div>{!! $terms->content !!}</div>
</div>


@endsection