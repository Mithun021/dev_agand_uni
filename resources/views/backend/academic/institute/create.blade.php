@extends('backend.partial.master')
@section('title', 'Add Institute')
@section('backend-content')


<div class="row">
    @can('add-institute')
        <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0"><h4>Add Institute</h4></div>
            <form class="form theme-form" method="post" action="{{ route('institutes.store') }}">
                @csrf
            <div class="card-body">
                @if(session('message'))
                    {!! session('message') !!}
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

@endsection

