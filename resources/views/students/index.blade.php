@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="page-title">
                <i class="fas fa-graduation-cap"></i> Students Management
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('students.create') }}" class="btn btn-primary btn-icon">
                <i class="fas fa-user-plus"></i> Add New Student
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td><strong>{{ $student->student_id }}</strong></td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone ?? 'N/A' }}</td>
                                <td>{{ Str::limit($student->address, 30) ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info btn-icon">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning btn-icon">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    No students found. <a href="{{ route('students.create') }}">Create one now!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
