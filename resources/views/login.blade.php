@extends('layouts.main')

@section('contents')
    @include('panels.flash-message')
    <div class="card">
        <div class="card-header">
            Welcome, please sign in
        </div>
        
        <div class="card-body">
            <form action="{{ route('login.attempt') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>


                <input type="submit" class="btn btn-sm btn-success" name="signin" id="signin">
                <a href="/">First time? Register here</a>
            </form>
        </div>
    </div>
@endsection

