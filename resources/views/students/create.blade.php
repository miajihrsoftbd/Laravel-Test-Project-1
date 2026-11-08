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

    <form action="{{ route('students.store') }}" method="POST">

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

        <button type="submit">Save Student</button>

    </form>

    <br>

    <a href="{{ route('students.index') }}">
        Back to Student List
    </a>

</body>
</html>