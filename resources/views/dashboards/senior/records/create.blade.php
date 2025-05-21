@extends('layouts.senior')

@section('content')
<h2>Add Senior Citizen</h2>

<form action="{{ route('senior.records.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Personal Info -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
        </div>
        <div class="col-md-4 mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label>Date of Birth</label>
            <input type="date" name="birth_date" class="form-control" required>
        </div>
        <div class="col-md-4 mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" min="59">
        </div>
        <div class="col-md-4 mb-3">
            <label>Place of Birth</label>
            <input type="text" name="place_of_birth" class="form-control" required>
        </div>
    </div>

    <!-- Civil Status -->
    <div class="mb-3">
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

    <!-- Barangay -->
    <div class="mb-3">
        <label>Barangay</label>
        <select name="address" class="form-control" required>
            <option value="">Select Barangay</option>
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

    <!-- Occupation & Income -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Occupation</label>
            <input type="text" name="occupation" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label>Annual Income</label>
            <select name="annual_income" class="form-control">
                <option value="">Select</option>
                <option>Below 100,000</option>
                <option>Above 100,000</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select class="form-select" name="gender" id="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
</div>

    <!-- Educational Attainment -->
    <div class="mb-3">
        <label>Educational Attainment</label>
        <input type="text" name="educational_attainment" class="form-control">
    </div>

    <!-- Contact Number -->
    <div class="mb-3">
        <label>Contact Number</label>
        <input type="text" name="contact_number" class="form-control" required>
    </div>

    <!-- Family Composition -->
    <hr>
    <h5>Family Composition</h5>
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
    <button type="button" class="btn btn-secondary mb-3" onclick="addFamilyMember()">+ Add Family Member</button>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

<script>
    let familyIndex = 1;

    function addFamilyMember() {
        const container = document.getElementById('family-composition');
        const row = `
        <div class="row mb-2">
            <div class="col">
                <input type="text" name="family[${familyIndex}][name]" class="form-control" placeholder="Name">
            </div>
            <div class="col">
                <select name="family[${familyIndex}][relationship]" class="form-control">
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
                <input type="number" name="family[${familyIndex}][age]" class="form-control" placeholder="Age">
            </div>
            <div class="col">
                <input type="text" name="family[${familyIndex}][civil_status]" class="form-control" placeholder="Civil Status">
            </div>
            <div class="col">
                <input type="text" name="family[${familyIndex}][occupation]" class="form-control" placeholder="Occupation">
            </div>
            <div class="col">
                <input type="text" name="family[${familyIndex}][income]" class="form-control" placeholder="Income">
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', row);
        familyIndex++;
    }
</script>
@endsection
