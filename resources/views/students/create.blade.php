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
        <button type="submit">Save Student</button>

    </form>

    <br>

    <a href="{{ route('students.index') }}">
        Back to Student List
    </a>

</body>
</html>