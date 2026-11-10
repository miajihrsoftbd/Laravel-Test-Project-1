
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Dashboard</title>


    <link rel="stylesheet"
     href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     
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
            
    <div class="col-md-2 bg-dark text-light min-vh-100 p-3">

          <a href="{{ route('dashboard') }}"
            class="nav-link">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('students.index') }}"
            class="nav-link">
                <i class="bi bi-people"></i> Student List
            </a>

            <a href="{{ route('students.create') }}"
            class="nav-link">
                <i class="bi bi-person-plus"></i> Add Student
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
