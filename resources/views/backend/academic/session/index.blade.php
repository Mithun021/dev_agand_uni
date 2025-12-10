@extends('backend.partial.master')
@section('title', 'Session')
@section('backend-content')

<div class="row">
  
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

@endsection
