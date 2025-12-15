@extends('backend.partial.master')
@section('title', 'Courses')
@section('sub_title', 'Add New Courses')
@section('backend-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="m-0">Course List</h4>
                <a href="{{ route('courses.index') }}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection