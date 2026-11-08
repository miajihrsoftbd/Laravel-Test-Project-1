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

        <button type="submit">Update Student</button>

    </form>

    <br>

    <a href="{{ route('students.index') }}">
        Back to Student List
    </a>

</body>
</html>