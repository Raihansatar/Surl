@extends('layouts.main')

@section('contents')
    <div class="card">
        <div class="card-header">
            Welcome, please sign in
        </div>

        @include('panels.flash-message')
        
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
            </form>
        </div>
    </div>
@endsection

