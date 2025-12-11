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



                            <div class="row">
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Course Type (Semester/Annual)<span
                                            class="text-danger">*</span></label>
                                    <select name="course_type" id="course_type"
                                        class="form-control @error('course_type') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('course_type') ? '' : 'selected' }}>Select Course
                                            Type</option>
                                        <option value="Semester" {{ old('course_type') == 'Semester' ? 'selected' : '' }}>
                                            Semester based exam</option>
                                        <option value="Annual" {{ old('course_type') == 'Annual' ? 'selected' : '' }}>Annual (yearly) based exam
                                        </option>
                                    </select>
                                    @error('course_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Semester dropdown (hidden by default) --}}
                            <div class="row" id="semester_row" style="display: none;">
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Semester<span class="text-danger">*</span></label>
                                    <select name="semester_id" class="form-control @error('semester_id') is-invalid @enderror">
                                        <option value="" disabled {{ old('semester_id') ? '' : 'selected' }}>Select
                                            Semester</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                                {{ $semester->semester }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('semester_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Annual dropdown --}}
                            <div class="row" id="annual_row" style="display: none;">
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Annual<span class="text-danger">*</span></label>
                                    <select name="annual_id" class="form-control @error('annual_id') is-invalid @enderror">
                                        <option value="" disabled {{ old('annual_id') ? '' : 'selected' }}>Select Annual
                                        </option>
                                        @foreach ($annuals as $annual)
                                            <option value="{{ $annual->id }}"
                                                {{ old('annual_id') == $annual->id ? 'selected' : '' }}>
                                                {{ $annual->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('annual_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>





                            <div class="row">
                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Branch</label>
                                    <select name="branch_id" class="form-control @error('branch_id') is-invalid @enderror">
                                        <option value="" disabled {{ old('branch_id') ? '' : 'selected' }}>Select Branch
                                        </option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                                {{ $branch->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('branch_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                        <th>Course Type</th>
                                        <th>Branch</th> 
                                        <th>Semester</th>
                                        <th>Annual(yearly)</th>                                                                           
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            
                                            <td>{{ $course->course }}</td>
                                            <td>{{ $course->course_type }}</td>
                                            <td>{{ $course->branch->branch_name ?? 'N/A' }}</td>
                                            <td>{{ $course->semester->semester ?? 'N/A' }}</td>
                                            <td>{{ $course->annual->year ?? 'N/A' }}</td>                                            
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

<script>
    console.log("Script Loaded"); // DEBUG
document.addEventListener('DOMContentLoaded', function() {
    let courseType = document.getElementById('course_type');
    let semesterRow = document.getElementById('semester_row');
    let annualRow = document.getElementById('annual_row');

    function toggleFields() { 
        console.log("Selected:", courseType.value); // DEBUG

        if (courseType.value === 'Semester') {
            semesterRow.style.display = 'block';
            annualRow.style.display = 'none';
            document.querySelector('select[name="annual_id"]').value = ""; // Clear annual selection
        } else if (courseType.value === 'Annual') {
            semesterRow.style.display = 'none';
            annualRow.style.display = 'block';
            document.querySelector('select[name="semester_id"]').value = ""; // Clear semester selection
        } else {
            semesterRow.style.display = 'none';
            annualRow.style.display = 'none';
            document.querySelector('select[name="semester_id"]').value = "";
            document.querySelector('select[name="annual_id"]').value = "";
        }
    }

    toggleFields();
    courseType.addEventListener('change', toggleFields);
});
</script>


@endsection


    









