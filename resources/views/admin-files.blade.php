@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All Uploaded Files</h1>

    @if($fileUploads->isEmpty())
    <p>No files found.</p>
    @else
    @php
    $currentFolderName = null;
    @endphp

    @foreach ($fileUploads as $fileUpload)
    <!-- Only display name and file_name for super-admin -->
    @if(auth()->user() && auth()->user()->role == 'admin')
    <!-- Check if the name has changed (i.e., a new folder) -->
    @if($fileUpload->name !== $currentFolderName)
    @if($currentFolderName !== null)
    </table>
    @endif

    <!-- Display the new folder name -->
    <div class="mb-4">
        <h3>Folder: {{ $fileUpload->name }}</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Is Premium</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $currentFolderName = $fileUpload->name;
                @endphp
                @endif

                <!-- List the files within the folder -->
                @foreach ($fileUpload->trackFiles as $trackFile)
                <tr>
                    <td>{{ basename($trackFile->filepath) }}</td>
                    <td>{{ $trackFile->is_premium == 1 ? 'true' : 'false' }}</td>

                    <!-- Display the file name -->
                    <td>
                        <!-- Download Button -->
                        <a href="{{ route('force.download', ['filepath' => $trackFile->filepath]) }}" style="width: auto !important;" target="_blank" class="btn btn-primary" download>
                            Download
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('files.delete', $trackFile->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="width: auto !important;" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
                @endforeach

                <!-- Close the last table if there was any file displayed -->
                @if($currentFolderName !== null)
            </tbody>
        </table>
        @endif

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                @if ($fileUploads->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $fileUploads->previousPageUrl() }}" aria-label="Previous">Previous</a>
                </li>
                @endif

                @foreach ($fileUploads->getUrlRange(1, $fileUploads->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $fileUploads->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach

                @if ($fileUploads->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $fileUploads->nextPageUrl() }}" aria-label="Next">Next</a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
                @endif
            </ul>
        </nav>
        @endif
    </div>
    @endsection