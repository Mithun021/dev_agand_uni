@extends('backend.partial.master')
@section('title', 'Courses')
@section('sub_title', 'Add New Courses')
@section('backend-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="m-0">Course List</h4>
                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-dark">Back</a>
            </div>
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="row">

                        {{-- Course Name --}}
                        <div class="col-md-12 form-group mb-2">
                            <label>Course Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Course Code --}}
                        <div class="col-md-6 form-group mb-2">
                            <label>Course Code</label>
                            <input type="text" name="course_code" class="form-control" value="{{ old('course_code') }}">
                        </div>

                        {{-- Course Type --}}
                        <div class="col-md-6 form-group mb-2">
                            <label>Course Type <span class="text-danger">*</span></label>
                            <select name="course_type" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="Annual Based">Annual Based</option>
                                <option value="Semester Based">Semester Based</option>
                            </select>
                            @error('course_type') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Semester --}}
                        <div class="col-md-4 form-group mb-2">
                            <label>Semester</label>
                            <div class="border p-2">
                                @foreach($semesters as $semester)
                                    <div>
                                        <input type="checkbox" name="semester[]" value="{{ $semester->id }}">
                                        {{ $semester->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Scheme --}}
                        <div class="col-md-4 form-group mb-2">
                            <label>Scheme <span class="text-danger">*</span></label>
                            <div class="border p-2">
                                @foreach($schemes as $scheme)
                                    <div>
                                        <input type="checkbox" name="scheme[]" value="{{ $scheme->id }}">
                                        {{ $scheme->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Session / Batch --}}
                        <div class="col-md-4 form-group mb-2">
                            <label>Session / Batch <span class="text-danger">*</span></label>
                            <div class="border p-2">
                                @foreach($batches as $batch)
                                    <div>
                                        <input type="checkbox" name="batch[]" value="{{ $batch->id }}">
                                        {{ $batch->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Institute --}}
                        <div class="col-md-12 form-group mb-2">
                            <label>Institute <span class="text-danger">*</span></label>
                            <div class="border p-2">
                                @foreach($institutes as $institute)
                                    <div class="d-inline-block mr-3">
                                        <input type="checkbox" name="institute[]" value="{{ $institute->id }}">
                                        {{ $institute->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Course</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection