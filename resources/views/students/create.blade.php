<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

    <h1>Add New Student</h1>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('students.store') }}"
      method="POST"
      enctype="multipart/form-data">

        @csrf

        <label>Name:</label>
        <input type="text" name="name">
        <br><br>

        <label>Email:</label>
        <input type="email" name="email">
        <br><br>

        <label>Phone:</label>
        <input type="text" name="phone">
        <br><br>

        <label>Address:</label>
        <input type="text" name="address">
        <br><br>

        <div class="mb-3">
            <label class="form-label">Student Photo</label>

            <input type="file"
                name="photo"
                class="form-control"
                accept="image/*">
        </div>
        <br><br>

        <!-- Gender -->
        <div class="mb-3">
            <label class="form-label">Gender</label>

            <select name="gender" class="form-select">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <br>    
        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>

            <select name="status" class="form-select">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <br><br>
        <button type="submit">Save Student</button>

    </form>

    <br>

    <a href="{{ route('students.index') }}">
        Back to Student List
    </a>

</body>
</html>