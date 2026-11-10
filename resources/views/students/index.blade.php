
@extends('layouts.app')

@section('content')

 

<!-- All student List -->
       
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">All Students</h5>
            </div>

            <div class="card-body">



        <form action="{{ route('students.index') }}" method="GET" class="mb-4">

            <div class="row g-2">

                <!-- Search -->
                <div class="col-md-4">
                    <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search name, email or phone..."
                        value="{{ request('search') }}">
                </div>

                <!-- Gender Filter -->
                <div class="col-md-3">
                    <select name="gender" class="form-select">
                        <option value="">All Gender</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>

                    <a href="{{ route('students.index') }}"
                    class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>

        </form>


                <!-- Student Table -->
                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($students as $student)

                            <tr>
                                <td>{{ $student->id }}</td>

                                <td>
                                    @if($student->photo)
                                        <img src="{{ asset('storage/'.$student->photo) }}"
                                            width="45"
                                            height="45"
                                            class="rounded-circle"
                                            style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                            style="width:45px;height:45px;">
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>

                                <td class="fw-semibold">
                                    {{ $student->name }}
                                </td>

                                <td>{{ $student->email }}</td>

                                <td>{{ $student->phone }}</td>

                                <td>{{ $student->gender ?? 'N/A' }}</td>

                                <td>
                                    @if($student->status == 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('students.show', $student->id) }}"
                                    class="btn btn-sm btn-info text-white">
                                        View
                                    </a>

                                    <a href="{{ route('students.edit', $student->id) }}"
                                    class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('students.destroy', $student->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>

                                    </form>
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    No students found!
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $students->links() }}
                </div>

            </div>
        </div>



@endsection