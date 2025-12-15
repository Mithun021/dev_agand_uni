@extends('backend.partial.master')
@section('title', 'Courses')
@section('sub_title', 'Course List')
@section('backend-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="m-0">Course List</h4>
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered dt-responsive nowrap"  id="responsive-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Course Type</th>
                                <th>Schemes</th>
                                <th>Semester</th>
                                <th>Session</th>
                                <th>Institute</th>
                                <th scope="col" id="no-export">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <strong>{{ $course->name }}</strong><br>
                                    <small class="text-muted">{{ $course->course_code }}</small>
                                </td>

                                <td>
                                    <span class="badge badge-info">
                                        {{ $course->course_type }}
                                    </span>
                                </td>

                                {{-- Schemes --}}
                                <td>
                                    @if($course->schemes->count())
                                        <ul class="mb-0 pl-3">
                                            @foreach($course->schemes as $scheme)
                                                <li>{{ $scheme->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                {{-- Semester --}}
                                <td>
                                    @if($course->semesters->count())
                                        <ul class="mb-0 pl-3">
                                            @foreach($course->semesters as $semester)
                                                <li>{{ $semester->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                {{-- Session / Batch --}}
                                <td>
                                    @if($course->batches->count())
                                        <ul class="mb-0 pl-3">
                                            @foreach($course->batches as $batch)
                                                <li>{{ $batch->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                {{-- Institute --}}
                                <td>
                                    @if($course->institutes->count())
                                        <ul class="mb-0 pl-3">
                                            @foreach($course->institutes as $institute)
                                                <li>{{ $institute->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                {{-- Action --}}
                                <td id="no-export">
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No courses found</td>
                            </tr>
                            @endforelse
                            </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection