@extends('backend.partial.master')
@section('title', 'Branch')
@section('backend-content')

<div class="row">
    {{-- Left Column: Add Branch --}}
    @can('add-branch')
        <div class="col-md-5">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Add Branch</h4>
                </div>

                <form class="form theme-form" method="post" action="{{ route('branches.store') }}">
                    @csrf
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="branch_name" value="{{ old('branch_name') }}">
                            <span class="text-danger">@error('branch_name'){{ $message }}@enderror</span>
                        </div>

                    </div>

                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    {{-- Right Column: Branch List --}}
    @can('show-branch')
        <div class="col-md-7">
            <div class="card">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Branch List</h4>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" id="responsive-datatable">
                            <thead>
                                <tr>
                                
                                    <th>Branch Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        
                                        <td>{{ $branch->branch_name }}</td>
                                        <td>
                                            <a href="{{ route('branches.edit', $branch->id) }}"
                                               class="btn btn-sm btn-primary">Edit</a>

                                            <form action="{{ route('branches.destroy', $branch->id) }}"
                                                  method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this branch?')">
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


























