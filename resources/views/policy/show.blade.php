@extends('layouts.admin')

@section('content')
<div class="container">
    <h5 class="border-bottom pb-3 fw-light mt-5 p-4">{{ $policy->title }}</h5>
    <div>{!! $policy->content !!}</div>
</div>

@endsection