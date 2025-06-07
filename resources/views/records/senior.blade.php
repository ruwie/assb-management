@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>👴 Senior Citizen Record List</h2>

    <!-- Add Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSeniorModal">
        ➕ Add Senior
    </button>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <!-- Records Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>2x2 Picture</th>
                    <th>Senior Citizen ID</th>
                    <th>Full Name</th>
                    <th>Action</th>
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
                        <td>
                            <button 
                            class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#viewSeniorModal"
                            data-id="{{ $senior->id }}"              
                            data-photo="{{ asset('storage/seniors/' . $senior->photo) }}"
                            data-seniorid="{{ $senior->senior_id }}"
                            data-lastname="{{ $senior->last_name }}"
                            data-firstname="{{ $senior->first_name }}"
                            data-middlename="{{ $senior->middle_name }}">
                            View
                        </button>

                                
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Senior Modal -->
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
                <button type="submit" class="btn btn-success" id="openConfirmModal">Save Senior</button>
            </div>

        </form>
    </div>
</div>

<!-- View/Edit Senior Modal -->
<div class="modal fade" id="viewSeniorModal" tabindex="-1" aria-labelledby="viewSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="edit-form" method="POST" action="{{ route('senior.update', ['id' => 0]) }}">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Senior Citizen Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit-id" name="id">

          <div class="row mb-3">
            <div class="col-md-3">
              <img id="senior-photo" src="" alt="Senior Photo" class="img-thumbnail" style="width: 100%;">
            </div>

            <div class="col-md-9">
              <p><strong>Senior Citizen ID:</strong> <span id="senior-id-text"></span></p>

              <div class="mb-2">
                <label><strong>Last Name:</strong></label>
                <input type="text" class="form-control editable" id="edit-lastname" name="last_name" readonly>
              </div>

              <div class="mb-2">
                <label><strong>First Name:</strong></label>
                <input type="text" class="form-control editable" id="edit-firstname" name="first_name" readonly>
              </div>

              <div class="mb-2">
                <label><strong>Middle Name:</strong></label>
                <input type="text" class="form-control editable" id="edit-middlename" name="middle_name" readonly>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="delete-btn">
                Delete
            </button>

            <button type="button" class="btn btn-warning" id="edit-toggle-btn">Edit</button>
            <button type="submit" class="btn btn-success d-none" id="save-edit-btn">Save Changes</button>
            <button type="button" class="btn btn-secondary" onclick="window.print()">Print</button>
        </div>
      </form>

      <!-- ✅ Delete Form (OUTSIDE the edit form) -->
      <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
      </form>
    </div>
  </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function () {
  // Define route templates using Laravel's route helper
  const deleteRouteTemplate = @json(route('senior.destroy', ['id' => 'PLACEHOLDER']));
  const updateRouteTemplate = @json(route('senior.update', ['id' => 'PLACEHOLDER']));

  const viewModal = document.getElementById('viewSeniorModal');

  // Handle modal show event
  viewModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    // Extract data attributes
    const id = button.getAttribute('data-id');
    const photo = button.getAttribute('data-photo');
    const seniorId = button.getAttribute('data-seniorid');
    const lastname = button.getAttribute('data-lastname');
    const firstname = button.getAttribute('data-firstname');
    const middlename = button.getAttribute('data-middlename');

    // Populate form fields
    document.getElementById('senior-photo').src = photo;
    document.getElementById('senior-id-text').textContent = seniorId;
    document.getElementById('edit-id').value = id;

    document.getElementById('edit-form').action = updateRouteTemplate.replace('PLACEHOLDER', id);
    document.getElementById('delete-form').action = deleteRouteTemplate.replace('PLACEHOLDER', id);

    document.getElementById('edit-lastname').value = lastname;
    document.getElementById('edit-firstname').value = firstname;
    document.getElementById('edit-middlename').value = middlename;

    // Disable input fields initially
    document.querySelectorAll('.editable').forEach(field => field.readOnly = true);

    // Show edit button, hide save
    document.getElementById('edit-toggle-btn').classList.remove('d-none');
    document.getElementById('save-edit-btn').classList.add('d-none');
  });

  // Enable editing
  document.getElementById('edit-toggle-btn').addEventListener('click', function () {
    document.querySelectorAll('.editable').forEach(field => field.readOnly = false);
    this.classList.add('d-none');
    document.getElementById('save-edit-btn').classList.remove('d-none');
  });

  // Handle delete
  document.getElementById('delete-btn').addEventListener('click', function () {
    const id = document.getElementById('edit-id').value;
    if (confirm('Are you sure you want to delete this record?')) {
      document.getElementById('delete-form').submit();
    }
  });

  // handle add confimration
  document.getElementById('openConfirmModal').addEventListener('click', function () {
  if (confirm('Are you sure you want to save this new senior citizen?')) {
    document.getElementById('add-senior-form').submit();
  }
});
});
</script>





@endsection
