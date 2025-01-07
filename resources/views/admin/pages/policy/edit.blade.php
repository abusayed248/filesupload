@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card mt-5">

        <div class="card-body">
            <form method="POST" action="{{ route('policy.update') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="inputName">Title:</label>
                    <input
                        type="text"
                        name="title"
                        id="inputName"
                        value="{{ old('title', $policy->title) }}"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Name">

                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="inputEmail">Body:</label>
                    <div id="quill-editor" class="mb-3" style="height: 300px;">
                    </div>
                    <textarea
                        rows="3"
                        class="mb-3 d-none"
                        name="content"
                        id="quill-editor-area"></textarea>


                    @error('content')
                    <span class="text-danger">{{ $message }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <button class="btn btn-success btn-submit">Submit</button>
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