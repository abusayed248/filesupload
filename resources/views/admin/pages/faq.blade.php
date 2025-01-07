@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <h2>Faq</h2>
        </div>
        <div class="col-md-6">
            <a href="{{ route('add.faq') }}" class="btn btn-success">Add+</a>
        </div>
    </div>
    <table id="jquery-datatable-example-no-configuration" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $key => $faq)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $faq->title }}</td>
                    <td>{{ Str::of($faq->description)->limit(100)}}</td>
                    <td colspan="2">
                        <a href="{{ route('edit.faq', $faq->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('delete.faq', $faq->id) }}" class="btn btn-danger">Delete</a>
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