@extends('backend.partial.master')
@section('title', 'Edit Semester')
@section('backend-content')

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            <div class="card-header pb-0"><h4>Edit Semester</h4></div>
            <form class="form theme-form" method="POST" action="{{ route('semesters.update',$semester->id) }}">
                @csrf
                @method('PUT')
            <div class="card-body">
                @if(session('message'))
                    {!! session('message') !!}
                @endif
                <div class="row">
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Semester</label>
                        <input class="form-control" type="text" name="semester" value="{{ old('semester',$semester->semester) }}" >
                        <span class="text-danger">@error('semester'){{ $message }} @enderror</span>
                    </div>
                    
            <div class="card-footer text-end py-2">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
