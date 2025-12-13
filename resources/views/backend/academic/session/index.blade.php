@extends('backend.partial.master')
@section('title', 'Session')
@section('backend-content')

<div class="row">

    {{-- Left Column — Add Session --}}
    @can('add-user')
        <div class="col-md-5">
            <div class="card">

                <div class="card-header pb-0">
                    <h4>Add Session</h4>
                </div>

                <form class="form theme-form" method="POST" action="{{ route('sessions.store') }}">
                    @csrf

                    <div class="card-body">

                        @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                        {{-- Session Name --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Session <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="session"
                                   value="{{ old('session') }}" placeholder="Enter session">

                            @error('session')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="is_active"
                                    class="form-control @error('is_active') is-invalid @enderror">

                                <option value="">Select Status</option>
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>

                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary px-4" type="submit">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    @endcan

    {{-- Right Column — Session List --}}
    @can('show-session')
        <div class="col-md-7">
            <div class="card">

                {{-- Header --}}
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Session List</h4>
                </div>

                {{-- Table --}}
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered dt-responsive nowrap" id="responsive-datatable">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Session</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($sessions as $session)
                                    <tr>
                                        {{-- <td>{{ $session->id }}</td> --}}
                                        <td>{{ $session->session }}</td>

                                        {{-- Status Badge --}}
                                        <td>
                                            @if($session->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        {{-- Action Buttons --}}
                                        <td>
                                            <a href="{{ route('sessions.edit', $session->id) }}"
                                               class="btn btn-sm btn-primary">Edit</a>

                                            <form action="{{ route('sessions.destroy', $session->id) }}"
                                                  method="POST" style="display: inline-block;">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this session?')">
                                                    Delete
                                                </button>

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








































{{-- @extends('backend.partial.master')
@section('title', 'Session')
@section('backend-content')

<div class="row">

    <div class="row">
    @can('add-user')
        <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0"><h4>Add Session</h4></div>
            <form class="form theme-form" method="post" action="{{ route('sessions.store') }}">
                @csrf
            <div class="card-body">
                @if(session('message'))
                    {!! session('message') !!}
                @endif
                <div class="row">
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Session<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="session" value="{{ old('session') }}" >
                        <span class="text-danger">@error('session'){{ $message }} @enderror</span>
                    </div>
                    
                </div>

                <div class="col-md-6">
                                    <label for="input14" class="form-label">Status</label>
                                    <div class="position-relative input-icon">
                                        <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" id="input14" required>
                                            <option value="" disabled {{ old('is_active', '1') === '' ? 'selected' : '' }}>Select Status</option>
                                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <span class="position-absolute top-50 translate-middle-y"><i class="bi bi-toggle-on"></i></span>
                                        @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
    
</div>
  
    @can('show-session')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0"><h4>Session</h4></div>
            <div>
                <a href="{{ route('sessions.create') }}"><button type="submit">Add Session</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered dt-responsive nowrap"  id="responsive-datatable">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Session</th>
                            <th>Status</th>
                            <th>Actions</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sessions as $session)
                            <tr>
                                <td>{{ $session->id }}</td>
                                <td>{{ $session->session }}</td>
                                <td>{{ $session->is_active }}</td>
                                <td>
                                
                                    <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this session?')">Delete</button>
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

@endsection --}}
