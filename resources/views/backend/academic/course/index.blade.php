@extends('backend.partial.master')
@section('title', 'Course')
@section('backend-content')

    <div class="row">
        {{-- Add Course Form --}}
        @can('add-course')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Add Course</h4>
                    </div>
                    <form class="form theme-form" method="post" action="{{ route('courses.store') }}">
                        @csrf
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Course<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="course" value="{{ old('course') }}">
                                    <span class="text-danger">
                                        @error('course')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <label for="input14" class="form-label">Status</label>
                                <div class="position-relative input-icon">
                                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror"
                                        id="input14" required>
                                        <option value="" disabled {{ old('is_active', '1') === '' ? 'selected' : '' }}>
                                            Select Status</option>
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    <span class="position-absolute top-50 translate-middle-y"><i
                                            class="bi bi-toggle-on"></i></span>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end py-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endcan

        {{-- Course List Table --}}
        @can('show-course')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Courses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap" id="responsive-datatable">
                                <thead>
                                    <tr>
                                       
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            
                                            <td>{{ $course->course }}</td>
                                            <td>{{ $course->is_active ? 'Active' : 'Inactive' }}</td>
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


    









