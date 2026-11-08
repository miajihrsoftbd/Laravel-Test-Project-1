
@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Student Details</h2>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Back to Dashboard
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Student Profile</h5>
        </div>

        <div class="card-body">

            @if($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}"
                    alt="Student Photo"
                    width="150"
                    height="150"
                    class="rounded-circle mb-3"
                    style="object-fit: cover;">
            @else
                <p class="text-muted">No photo uploaded</p>
            @endif

            <h4 class="fw-bold">{{ $student->name }}</h4>

            <hr>

            <p><strong>Student ID:</strong> {{ $student->id }}</p>

            <p><strong>Name:</strong> {{ $student->name }}</p>

            <p><strong>Email:</strong> {{ $student->email }}</p>

            <p><strong>Phone:</strong> {{ $student->phone }}</p>

            <p><strong>Address:</strong> {{ $student->address }}</p>

            <a href="{{ route('students.edit', $student->id) }}"
               class="btn btn-warning mt-3">
                Edit Student
            </a>

        </div>
    </div>

</div>

@endsection
