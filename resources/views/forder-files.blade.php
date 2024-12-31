@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Uploaded Files</h1>

    @if($TrackFile->isEmpty())
        <p>No files found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($TrackFile as $trackFile)
                    <tr>
                        <td>{{ basename($trackFile->filepath) }}</td> <!-- Display the file name -->
                        <td>
                            <a href="{{ $trackFile->filepath }}" target="_blank" class="btn btn-primary" download>
                                Download
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                @if ($TrackFile->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $TrackFile->previousPageUrl() }}" aria-label="Previous">Previous</a>
                    </li>
                @endif

                @foreach ($TrackFile->getUrlRange(1, $TrackFile->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $TrackFile->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                @if ($TrackFile->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $TrackFile->nextPageUrl() }}" aria-label="Next">Next</a>
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
