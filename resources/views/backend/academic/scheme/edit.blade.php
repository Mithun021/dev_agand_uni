@extends('backend.partial.master')
@section('title', 'Edit Scheme')
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
            <div class="card-header pb-0"><h4>Edit Scheme</h4></div>
            <form class="form theme-form" method="POST" action="{{ route('schemes.update', $scheme->id) }}">
                @csrf
                @method('PUT')
            <div class="card-body">
                @if(session('message'))
                    {!! session('message') !!}
                @endif
                <div class="row">
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Scheme Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name',$scheme->name) }}" >
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                    </div>
                    
            <div class="card-footer text-end py-2">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('schemes.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
