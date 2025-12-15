@extends('backend.partial.master')
@section('title', 'Dashboard')
@section('backend-content')

<div class="row">
    <div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
        <h4>{{ $user->name }}</h4><span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
        </div>
        <div class="card-body">
        <p class="mb-0">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
        <h1>Collab Account 2</h1>
        </div>
    </div>
    </div>
</div>

@endsection