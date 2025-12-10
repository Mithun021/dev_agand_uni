@extends('backend.partial.master')
@section('title', 'Course')
@section('backend-content')

    <div class="row">

        @can('show-course')
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Course</h4>
                    </div>
                    <div>
                <a href="{{ route('courses.create') }}"><button type="submit">Add Course</button></a>
            </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-bordered dt-responsive nowrap" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{ $course->id }}</td>
                                            <td>{{ $course->course }}</td>
                                            <td>{{ $course->is_active }}</td>
                                            <td>

                                                <a href="{{ route('courses.edit', $course->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>

@endsection
