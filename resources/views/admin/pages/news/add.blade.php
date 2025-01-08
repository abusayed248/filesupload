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
            <h2>Add News</h2>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Back</a>
        </div>
    </div>

    <div class="row card justify-content-center align-items-center">
        <div class="col-md-6 card-body">
            <form action="{{ route('store.news') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control border" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="inputEmail">Body</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;"> </div>
                    <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area"></textarea>
                </div>
                
                <div class="mb-3 ">
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>

              </form>
        </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            // Check if there is existing content for editing
            var descriptionContent = `{!! old('content', $policy->content ?? '') !!}`;

            // Set the content for Quill editors if it exists
            if (descriptionContent) {
                editor.root.innerHTML = descriptionContent;
            }

            var quillEditor = document.getElementById('quill-editor-area');
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });

            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });
        }
    });
</script>


@endsection