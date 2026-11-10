<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

    <h1>Edit Student Information</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('students.update', $student->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <label>Name:</label>
        <input type="text" name="name"
               value="{{ old('name', $student->name) }}">
        <br><br>

        <label>Email:</label>
        <input type="email" name="email"
               value="{{ old('email', $student->email) }}">
        <br><br>

        <label>Phone:</label>
        <input type="text" name="phone"
               value="{{ old('phone', $student->phone) }}">
        <br><br>

        <label>Address:</label>
        <input type="text" name="address"
               value="{{ old('address', $student->address) }}">
        <br><br>

        <div class="mb-3">
            <label class="form-label">Gender</label>

            <select name="gender" class="form-select">
                <option value="Male"
                    {{ $student->gender == 'Male' ? 'selected' : '' }}>
                    Male
                </option>

                <option value="Female"
                    {{ $student->gender == 'Female' ? 'selected' : '' }}>
                    Female
                </option>

                <option value="Other"
                    {{ $student->gender == 'Other' ? 'selected' : '' }}>
                    Other
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>

            <select name="status" class="form-select">
                <option value="Active"
                    {{ $student->status == 'Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="Inactive"
                    {{ $student->status == 'Inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        <button type="submit">Update Student</button>

    </form>

    <br>

    <a href="{{ route('students.index') }}">
        Back to Student List
    </a>

</body>
</html>