@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>👴 Senior Citizen Record List</h2>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSeniorModal">
        ➕ Add Senior
    </button>

    <!-- Records Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>2x2 Picture</th>
                    <th>Senior Citizen ID</th>
                    <th>Full Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seniors as $senior)
                    <tr>
                        <td>
                        @if($senior->photo)
                            <img src="{{ asset('storage/seniors/' . $senior->photo) }}" alt="Photo" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                        @else
                            No Photo
                        @endif
                    </td>
                        <td>{{ $senior->senior_id }}</td>
                        <td>{{ $senior->last_name }}, {{ $senior->first_name }} {{ $senior->middle_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addSeniorModal" tabindex="-1" aria-labelledby="addSeniorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('senior.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Senior</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="photo" class="form-label">2x2 Picture</label>
                    <input type="file" class="form-control" name="photo" required>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="middle_name">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Senior</button>
            </div>
        </form>
    </div>
</div>
@endsection
