@extends('backend.partial.master')
@section('title', 'Scheme')
@section('backend-content')

<div class="row">
    {{-- Left Column: Add Scheme --}}
    @can('add-scheme')
        <div class="col-md-5">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Add Scheme</h4>
                </div>

                <form class="form theme-form" method="post" action="{{ route('schemes.store') }}">
                    @csrf
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label class="form-label">Scheme Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                        </div>

                    </div>

                    <div class="card-footer text-end py-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    {{-- Right Column: Scheme List --}}
    @can('show-scheme')
        <div class="col-md-7">
            <div class="card">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Scheme List</h4>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap" id="responsive-datatable">
                            <thead>
                                <tr>
                                
                                    <th>Scheme Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($schemes as $scheme)
                                    <tr>
                                        
                                        <td>{{ $scheme->name }}</td>
                                        <td>
                                            <a href="{{ route('schemes.edit', $scheme->id) }}"
                                               class="btn btn-sm btn-primary">Edit</a>

                                            <form action="{{ route('schemes.destroy', $scheme->id) }}"
                                                  method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this scheme?')">
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


























