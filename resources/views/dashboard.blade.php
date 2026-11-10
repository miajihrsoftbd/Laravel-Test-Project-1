
@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Welcome to Student Management System</p>
            </div>

           
        </div>

         <!-- Statistics Cards -->

        <div class="row g-4 mb-4">

            <!-- Total Students -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Total Students</h6>
                        <h2 class="fw-bold text-primary">
                            {{ $totalStudents }}
                        </h2>
                        <small class="text-muted">All registered students</small>
                    </div>
                </div>
            </div>

            <!-- Active Students -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Active Students</h6>
                        <h2 class="fw-bold text-success">
                            {{ $activeStudents }}
                        </h2>
                        <small class="text-success">Currently active</small>
                    </div>
                </div>
            </div>

            <!-- Inactive Students -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-muted">Inactive Students</h6>
                        <h2 class="fw-bold text-danger">
                            {{ $inactiveStudents }}
                        </h2>
                        <small class="text-danger">Currently inactive</small>
                    </div>
                </div>
            </div>

        </div>


<div class="row mt-4">

    <!-- Gender Chart -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Students by Gender</h5>
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Monthly Chart -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h5 class="card-title mb-3">Monthly Registration</h5>
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- Recent Students -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Recent Students</h5>

            <a href="{{ route('students.index') }}"
               class="btn btn-sm btn-outline-primary">
                View All
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentStudents as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->gender ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $student->status == 'Active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $student->status }}
                                </span>
                            </td>
                            <td>{{ $student->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Gender Chart
    const genderLabels = @json($genderStats->keys());
    const genderData = @json($genderStats->values());

    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: genderLabels,
            datasets: [{
                data: genderData,
                backgroundColor: ['#0d6efd', '#e83e8c', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    // Monthly Registration Chart
    new Chart(document.getElementById('monthlyChart'), {
        type: 'bar',
        data: {
            labels: @json($monthLabels),
            datasets: [{
                label: 'New Students',
                data: @json($monthData),
                backgroundColor: '#198754',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>

@endsection
