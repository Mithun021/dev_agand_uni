@extends('backend.partial.master')
@section('title', 'Edit Annual')
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
            <div class="card-header pb-0"><h4>Edit Annual</h4></div>
            <form class="form theme-form" method="POST" action="{{ route('annuals.update',$annual->id) }}">
                @csrf
                @method('PUT')
            <div class="card-body">
                @if(session('message'))
                    {!! session('message') !!}
                @endif
                <div class="row">
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Annual</label>
                        <input class="form-control" type="text" name="year" value="{{ old('year',$annual->year) }}" >
                        <span class="text-danger">@error('year'){{ $message }} @enderror</span>
                    </div>
                    
            <div class="card-footer text-end py-2">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('annuals.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
