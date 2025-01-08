@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <h2>Faq</h2>
        </div>
        <div class="col-md-6  d-flex justify-content-end mb-3">
            <a href="{{ route('add.testimonial') }}" class="btn btn-success">Add+</a>
        </div>
    </div>
    <table id="jquery-datatable-example-no-configuration" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testimonials as $key => $testimonial)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        <img height="40" width="60" src="{{ asset($testimonial->photo) }}" alt="">
                    </td>
                    <td>{{ $testimonial->name }}</td>
                    <td>{{ Str::of($testimonial->description)->limit(100)}}</td>
                    <td colspan="2">
                        <a href="{{ route('edit.testimonial', $testimonial->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('delete.testimonial', $testimonial->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#jquery-datatable-example-no-configuration').DataTable();
    });
</script>


@endsection