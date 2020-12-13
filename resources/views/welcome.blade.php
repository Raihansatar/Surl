@extends('layouts.main')

@section('contents')
    
    <div class="card">
        <div class="card-header">
            Welcome, Paste the URL to be shortened
        </div>
        
        <div class="card-body">
            <form action="{{ route('url.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <label for="">Link</label>
                    <input type="text" name="link" id="">
                </div>
                <input type="submit" name="submit" id="">
            </form>
        </div>
    </div>

@endsection