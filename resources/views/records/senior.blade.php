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
                              data-middlename="{{ $senior->middle_name }}"
                              data-dob="{{ $senior->dob }}"
                              data-age="{{ $senior->age }}"
                              data-occupation="{{ $senior->occupation }}"
                              data-house_no="{{ $senior->house_no }}"
                              data-barangay="{{ $senior->barangay }}"
                            >
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
                    <input type="file" class="form-control" name="photo" required >
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
                <div class="mb-3">
                  <label for="dob" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" name="dob" id="dob" required>
              </div>

              <div class="mb-3">
                  <label for="age" class="form-label">Age</label>
                  <input type="number" class="form-control" name="age" id="age" readonly>
              </div>

              <div class="mb-3">
                  <label for="occupation" class="form-label">Occupation</label>
                  <input type="text" class="form-control" name="occupation" required>
              </div>

              <div class="mb-3">
                  <label for="house_no" class="form-label">House No. / Street</label>
                  <input type="text" class="form-control" name="house_no" required>
              </div>

              <div class="mb-3">
                  <label for="barangay" class="form-label">Barangay</label>
                  <select name="barangay" id="barangay" class="form-control" required>
                      <option value="" disabled selected>Select Barangay</option>
                      <option value="Bangkal">Bangkal</option>
                      <option value="Calaylayan">Calaylayan</option>
                      <option value="Capitangan">Capitangan</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Laon">Laon</option>
                      <option value="Mabatang">Mabatang</option>
                      <option value="Omboy">Omboy</option>
                      <option value="Salian">Salian</option>
                      <option value="Wawa">Wawa</option>
                  </select>
              </div>

              <div class="mb-3">
                  <label class="form-label">City / Province</label>
                  <input type="text" class="form-control" value="Abucay, Bataan" readonly>
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
              <div class="mb-2">
                  <label for="dob" class="form-label">Date of Birth:</label>
                  <input type="date" class="form-control editable" id="edit-dob" name="dob" readonly>
              </div>

              <div class="mb-2">
                  <label for="age" class="form-label">Age:</label>
                  <input type="number" class="form-control editable" id="edit-age" name="age" readonly>
              </div>

              <div class="mb-2">
                  <label for="occupation" class="form-label">Occupation:</label>
                  <input type="text" class="form-control editable" name="occupation" id="edit-occupation" name="occupation" readonly>
              </div>

              <div class="mb-2">
                  <label for="house_no" class="form-label">House No. / Street</label>
                  <input type="text" class="form-control editable" id="edit-house_no" name="house_no" readonly>

              </div>

              <div class="mb-2">
                  <label for="barangay" class="form-label">Barangay</label>
                  <select class="form-control editable" id="edit-barangay" name="barangay" disabled>
                    <option value="" disabled selected>Select Barangay</option>
                    <option value="Bangkal">Bangkal</option>
                    <option value="Calaylayan">Calaylayan</option>
                    <option value="Capitangan">Capitangan</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Laon">Laon</option>
                    <option value="Mabatang">Mabatang</option>
                    <option value="Omboy">Omboy</option>
                    <option value="Salian">Salian</option>
                    <option value="Wawa">Wawa</option>
                  </select>
              </div>

              <div class="mb-2">
                  <label class="form-label">City / Province</label>
                  <input type="text" class="form-control" value="Abucay, Bataan" readonly>
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

    document.getElementById('edit-dob').value = button.getAttribute('data-dob');
    document.getElementById('edit-age').value = button.getAttribute('data-age');
    document.getElementById('edit-occupation').value = button.getAttribute('data-occupation');
    document.getElementById('edit-house_no').value = button.getAttribute('data-house_no');
    document.getElementById('edit-barangay').value = button.getAttribute('data-barangay');

    // Disable input fields initially
    document.querySelectorAll('.editable').forEach(field => {
      if (field.tagName === 'SELECT') {
        field.disabled = true;
      } else {
        field.readOnly = true;
      }
    });

    // Show edit button, hide save
    document.getElementById('edit-toggle-btn').classList.remove('d-none');
    document.getElementById('save-edit-btn').classList.add('d-none');
  });

  // Enable editing
  document.getElementById('edit-toggle-btn').addEventListener('click', function () {
    document.querySelectorAll('.editable').forEach(field => {
      if (field.tagName === 'SELECT') {
        field.disabled = false;
      } else {
        field.readOnly = false;
      }
    });

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


  document.getElementById('edit-dob').addEventListener('change', function () {
    const dob = new Date(this.value);
    const today = new Date();
    let age = today.getFullYear() - dob.getFullYear();
    const m = today.getMonth() - dob.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
        age--;
    }

    document.getElementById('edit-age').value = age;
});
});
</script>





@endsection
