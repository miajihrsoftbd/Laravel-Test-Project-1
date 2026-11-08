
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary px-4">
        <a class="navbar-brand fw-bold" href="#">
            Student Management
        </a>

        <span class="text-white">Admin Panel</span>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 bg-dark min-vh-100 p-3">
                <h6 class="text-secondary mb-3">MENU</h6>

                <a href="{{ route('students.index') }}"
                   class="d-block text-white text-decoration-none p-2 mb-2">
                    Dashboard
                </a>

                <a href="{{ route('students.create') }}"
                   class="d-block text-white text-decoration-none p-2 mb-2">
                    Add Student
                </a>

                <a href="{{ route('students.index') }}"
                   class="d-block text-white text-decoration-none p-2">
                    Student List
                </a>
            </div>

            <!-- Main Content -->
            <main class="col-md-10 p-4">

                @yield('content')

            </main>

        </div>
    </div>

</body>
</html>
