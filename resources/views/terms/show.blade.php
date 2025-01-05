@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $terms->title }}</h1>
    <div>{!! $terms->content !!}</div>
</div>
@endsection
