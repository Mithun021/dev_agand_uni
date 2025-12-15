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
            <form action="" method="post">
                @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Course Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Course Code</label>
                        <input type="text" class="form-control" name="course_type">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Course Type<span class="text-danger">*</span></label>
                        <select name="course_type" class="form-control">
                            <option value="Annual Based">Annual Based</option>
                            <option value="Semester Based">Semester Based</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Semester</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Scheme<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Session<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Institute<span class="text-danger">*</span></label>
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