@extends('backend.partial.master')
@section('title', 'Edit Branch')
@section('backend-content')

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header pb-0">
                    <h4>Edit Branch</h4>
                </div>
                <form class="form theme-form" method="POST" action="{{ route('branches.update', $branch->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if (session('message'))
                            {!! session('message') !!}
                        @endif
                        <div class="row">

                            <div class="col-6 form-group mb-3">
                                <label class="form-label">Course</label>
                                <input class="form-control" type="text" name="course"
                                    value="{{ old('course', $branch->course->course) }}">
                                <span class="text-danger">
                                    @error('course')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-6 form-group mb-3">
                                <label class="form-label">Branch (If no branch, leave empty)</label>
                                <input class="form-control" type="text" name="branch_name" value="{{ old('branch_name', $branch->branch_name ?? '') }}">
                                <span class="text-danger">
                                    @error('branch_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="card-footer text-end py-2">
                                <button class="btn btn-primary">Update</button>
                                <a href="{{ route('branches.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                </form>
            </div>
        </div>
    </div>

@endsection
