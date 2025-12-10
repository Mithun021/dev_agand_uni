@extends('backend.partial.master')
@section('title', 'institute')
@section('backend-content')

<div class="row">
    @can('add-institute')
        <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0"><h4>Add Institute</h4></div>
            <form class="form theme-form" method="post" action="{{ route('institutes.store') }}">
                @csrf
            <div class="card-body">
                @if(session('success'))
                   <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Institute Name<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute" value="{{ old('institute') }}" >
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

    <div class="row">

        @can('show-institute')
            <div class="col-sm-12">
                <div class="card">
                    @if(session('sucess'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif    
                  
                   <div class="card-header pb-2 d-flex align-items-center justify-content-between">
    <h4 class="mb-0">Institute</h4>

    <a href="{{ route('institutes.create') }}" 
       class="btn btn-primary px-3 py-1 rounded-pill shadow-sm d-flex align-items-center">
        <i class="bi bi-plus-circle me-2"></i>
        Add Institute
    </a>
</div>

                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-bordered dt-responsive nowrap" id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Institute Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($institutes as $institute)
                                        <tr>
                                            <td>{{ $institute->id }}</td>
                                            <td>{{ $institute->institute }}</td>
                                            <td>{{ $institute->is_active }}</td>
                                            <td>

                                                <a href="{{ route('institutes.edit', $institute->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('institutes.destroy', $institute->id) }}" method="POST"
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

@endsection
