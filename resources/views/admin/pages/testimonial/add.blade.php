@extends('layouts.admin')

@section('content')
<div class="container mt-3">
    <div class="row mb-2 pb-2" style="border: 2px solid #ddd">
        @if (session('status'))
            <div class="alert alert-success py-3">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-9">
            <h2>Add Testimonial</h2>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('all.testimonials') }}" class="btn btn-success">Back</a>
        </div>
    </div>

    <div class="row card justify-content-center align-items-center">
        <div class="col-md-6 card-body">
            <form action="{{ route('store.testimonial') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control border" id="name" name="name" required>
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Photo</label>
                  <input type="file" class="form-control border" id="photo" name="photo" required>
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea type="text" class="form-control border" id="description" name="description" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
    
</div>




@endsection