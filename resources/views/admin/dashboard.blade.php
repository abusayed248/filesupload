@extends('layouts.admin')

@section('title', 'Filesupload dashboard')
@section('content')
<main>
    <div class="container-fluid px-4">
       <div class="row">
        <div class="col-md-10">
            <h1 class="mt-4">Dashboard</h1>
        </div>
        <div class="col-md-2 text-end">
            <a href="{{ route('add.news') }}" class="btn btn-success">Add+</a>
        </div>
       </div>

@php
$news = \App\Models\News::get();
@endphp
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                News
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($news as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{!! Str::of($item->description)->limit(150) !!}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}</td>
                            <td>
                                <a href="{{ route('edit.news', $item->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('delete.news', $item->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
 @endsection