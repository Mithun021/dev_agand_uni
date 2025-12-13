@extends('backend.partial.master')
@section('title', 'Institute')
@section('backend-content')

<div class="row">
    {{-- Left Column: Add Institute --}}
    @can('add-institute')
        <div class="col-md-5">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Add Institute</h4>
                </div>

                <form class="form theme-form" method="post" action="{{ route('institutes.store') }}">
                    @csrf
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label class="form-label">Institute Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="institute" value="{{ old('institute') }}">
                            <span class="text-danger">@error('institute'){{ $message }}@enderror</span>
                        </div>

                          <div class="form-group mb-3">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="city" value="{{ old('city') }}">
                            <span class="text-danger">@error('city'){{ $message }}@enderror</span>
                        </div>

                          <div class="form-group mb-3">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="state" value="{{ old('state') }}">
                            <span class="text-danger">@error('state'){{ $message }}@enderror</span>
                        </div>

                          <div class="form-group mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        </div>

                         <div class="form-group mb-3">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                            <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                        </div>
                        

                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                                <option value="">Select Status</option>
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    {{-- Right Column: Institute List --}}
    @can('show-institute')
        <div class="col-md-7">
            <div class="card">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Institute List</h4>

                    {{-- <a href="{{ route('institutes.create') }}"
                       class="btn btn-primary px-3 py-1 rounded-pill shadow-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle me-1"></i>Add Institute
                    </a> --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" id="responsive-datatable">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Institute Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($institutes as $institute)
                                    <tr>
                                        {{-- <td>{{ $institute->id }}</td> --}}
                                        <td>{{ $institute->institute }}</td>
                                        <td>{{ $institute->city }}</td>
                                        <td>{{ $institute->state }}</td>
                                        <td>{{ $institute->email }}</td>
                                        <td>{{ $institute->phone }}</td>
                                        <td>{{ $institute->is_active ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('institutes.edit', $institute->id) }}"
                                               class="btn btn-sm btn-primary">Edit</a>

                                            <form action="{{ route('institutes.destroy', $institute->id) }}"
                                                  method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this institute?')">
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
