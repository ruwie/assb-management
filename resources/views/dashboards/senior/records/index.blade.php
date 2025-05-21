@extends('layouts.senior')

@section('content')
<h2 class="mb-4">Senior Citizen Records</h2>

<!-- Trigger Button -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSeniorModal">
    + Add
</button>
<!-- Add Senior Modal -->
<div class="modal fade" id="addSeniorModal" tabindex="-1" aria-labelledby="addSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ route('senior.records.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addSeniorModalLabel">Add Senior Citizen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row g-3">
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="birth_date" class="form-control" required>
          </div>
          <div class="col-md-2">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Place of Birth</label>
            <input type="text" name="place_of_birth" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Civil Status</label>
            <select name="civil_status" class="form-select" required>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Widowed">Widowed</option>
              <option value="Divorced">Divorced</option>
              <option value="Separated">Separated</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Address (Barangay)</label>
            <select name="address" class="form-select" required>
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
          <div class="col-md-6">
            <label class="form-label">Occupation</label>
            <input type="text" name="occupation" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Annual Income</label>
            <select name="income" class="form-select" required>
              <option value="Below 100,000">Below 100,000</option>
              <option value="100,000 and Above">100,000 and Above</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Educational Attainment</label>
            <input type="text" name="educational_attainment" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact_number" class="form-control">
          </div>

          <!-- Family Composition Section -->
          <h5 class="mt-4">Family Composition</h5>
<div id="family-group" class="row g-3">
    <div class="family-member row g-2 mb-2">
        <div class="col-md-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="family[0][name]" class="form-control" required>
        </div>

        <div class="col-md-2">
            <label class="form-label">Relationship</label>
            <select name="family[0][relationship]" class="form-select" required>
                <option value="">Select</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Son">Son</option>
                <option value="Daughter">Daughter</option>
                <option value="Uncle">Uncle</option>
                <option value="Auntie">Auntie</option>
                <option value="Cousin">Cousin</option>
                <option value="Friend">Friend</option>
                <option value="Grandfather">Grandfather</option>
                <option value="Grandmother">Grandmother</option>
            </select>
        </div>

        <div class="col-md-1">
            <label class="form-label">Age</label>
            <input type="number" name="family[0][age]" class="form-control" required>
        </div>

        <div class="col-md-2">
            <label class="form-label">Civil Status</label>
            <select name="family[0][civil_status]" class="form-select" required>
                <option value="">Select</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
                <option value="Divorced">Divorced</option>
                <option value="Separated">Separated</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Occupation</label>
            <input type="text" name="family[0][occupation]" class="form-control">
        </div>

        <div class="col-md-2">
            <label class="form-label">Income</label>
            <select name="family[0][income]" class="form-select">
                <option value="">Select</option>
                <option value="Below 100,000">Below 100,000</option>
                <option value="100,000 and above">100,000 and above</option>
                <option value="No Income">No Income</option>
            </select>
        </div>
    </div>
</div>

<!-- Button to add more family members -->
<div class="text-end">
    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addFamilyMember()">+ Add Family Member</button>
</div>

<!-- JavaScript to dynamically clone family fields -->
<script>
let familyIndex = 1;
function addFamilyMember() {
    const newMember = document.querySelector('.family-member').cloneNode(true);
    newMember.querySelectorAll('input, select').forEach(input => {
        const nameAttr = input.getAttribute('name');
        const newName = nameAttr.replace(/\[\d+\]/, `[${familyIndex}]`);
        input.setAttribute('name', newName);
        input.value = '';
    });
    document.getElementById('family-group').appendChild(newMember);
    familyIndex++;
}
</script>

        </div>

        <!-- Attachments -->
<div class="col-12">
  <label class="form-label">Upload Requirements (Optional)</label>
  <input type="file" name="attachments[]" class="form-control" multiple>
  <small class="text-muted">You can upload multiple files such as valid ID, birth certificate, etc.</small>
</div>


        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript to clone family row -->
<script>
  let familyIndex = 1;
  function addFamilyRow() {
    const container = document.getElementById('family-list');
    const newRow = container.children[0].cloneNode(true);

    newRow.querySelectorAll('input').forEach((input) => {
      const name = input.getAttribute('name');
      const updatedName = name.replace(/\[\d+\]/, `[${familyIndex}]`);
      input.setAttribute('name', updatedName);
      input.value = '';
    });

    container.appendChild(newRow);
    familyIndex++;
  }
</script>


<!-- Table of Records -->
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Profile</th>
            <th>Senior ID</th>
            <th>QR</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($seniors as $senior)
<tr>
    <td><img src="{{ asset('storage/' . $senior->profile_picture) }}" width="50" height="50"></td>
    <td>{{ $senior->senior_id }}</td>
    <td><img src="{{ asset('storage/' . $senior->qr_code) }}" width="50" height="50"></td>
    <td>{{ $senior->last_name }}, {{ $senior->first_name }}</td>
    <td>{{ $senior->gender }}</td>
    <td>{{ ucfirst($senior->status) }}</td>
    <td>
        <a href="#" class="btn btn-primary btn-sm">View</a>
    </td>
</tr>
@endforeach

    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('senior.records.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addModalLabel">Add New Senior Citizen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Personal Information -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                        </div>
                        <div class="col-md-4">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name">
                        </div>
                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="birth_date" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" placeholder="e.g. 65">
                        </div>
                        <div class="col-md-6">
                            <label>Place of Birth</label>
                            <input type="text" name="place_of_birth" class="form-control" placeholder="City/Province">
                        </div>
                    </div>

                    <!-- Address, Status, Income -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Civil Status</label>
                            <select name="civil_status" class="form-control" required>
                                <option value="">Select</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Widowed</option>
                                <option>Divorced</option>
                                <option>Separated</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Barangay (Abucay, Bataan)</label>
                            <select name="address" class="form-control" required>
                                <option>Bangkal</option>
                                <option>Calaylayan</option>
                                <option>Capitangan</option>
                                <option>Gabon</option>
                                <option>Laon</option>
                                <option>Mabatang</option>
                                <option>Omboy</option>
                                <option>Salian</option>
                                <option>Wawa</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Annual Income</label>
                            <select name="annual_income" class="form-control">
                                <option value="">Select</option>
                                <option>Below 100,000</option>
                                <option>Above 100,000</option>
                            </select>
                        </div>
                    </div>

                    <!-- Contact & Education -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Occupation</label>
                            <input type="text" name="occupation" class="form-control" placeholder="e.g. Retired Farmer">
                        </div>
                        <div class="col-md-6">
                            <label>Educational Attainment</label>
                            <input type="text" name="educational_attainment" class="form-control" placeholder="e.g. High School Graduate">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" placeholder="e.g. 09123456789">
                    </div>

                    <!-- Family Composition -->
                    <hr>
                    <h6>Family Composition</h6>
                    <div id="family-composition">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" name="family[0][name]" class="form-control" placeholder="Name">
                            </div>
                            <div class="col">
                                <select name="family[0][relationship]" class="form-control">
                                    <option>Mother</option>
                                    <option>Father</option>
                                    <option>Son</option>
                                    <option>Daughter</option>
                                    <option>Friend</option>
                                    <option>Grandfather</option>
                                    <option>Grandmother</option>
                                    <option>Auntie</option>
                                    <option>Uncle</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" name="family[0][age]" class="form-control" placeholder="Age">
                            </div>
                            <div class="col">
                                <input type="text" name="family[0][civil_status]" class="form-control" placeholder="Civil Status">
                            </div>
                            <div class="col">
                                <input type="text" name="family[0][occupation]" class="form-control" placeholder="Occupation">
                            </div>
                            <div class="col">
                                <input type="text" name="family[0][income]" class="form-control" placeholder="Income">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addFamilyMember()">+ Add Family Member</button>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Senior</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    let familyIndex = 1;

    function addFamilyMember() {
        const container = document.getElementById('family-composition');
        const row = `
        <div class="row mb-2">
            <div class="col"><input type="text" name="family[${familyIndex}][name]" class="form-control" placeholder="Name"></div>
            <div class="col">
                <select name="family[${familyIndex}][relationship]" class="form-control">
                    <option>Mother</option><option>Father</option><option>Son</option><option>Daughter</option>
                    <option>Friend</option><option>Grandfather</option><option>Grandmother</option>
                    <option>Auntie</option><option>Uncle</option>
                </select>
            </div>
            <div class="col"><input type="number" name="family[${familyIndex}][age]" class="form-control" placeholder="Age"></div>
            <div class="col"><input type="text" name="family[${familyIndex}][civil_status]" class="form-control" placeholder="Civil Status"></div>
            <div class="col"><input type="text" name="family[${familyIndex}][occupation]" class="form-control" placeholder="Occupation"></div>
            <div class="col"><input type="text" name="family[${familyIndex}][income]" class="form-control" placeholder="Income"></div>
        </div>`;
        container.insertAdjacentHTML('beforeend', row);
        familyIndex++;
    }
</script>
@endsection
