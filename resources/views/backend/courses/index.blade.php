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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection