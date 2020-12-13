@extends('layouts.main')

@section('contents')
    
    <div class="card">
        <div class="card-header">
            Welcome, Paste the URL to be shortened
        </div>

        @include('panels.flash-message')
        
        <div class="card-body">
            <form action="{{ route('url.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <label for="">Link</label>
                    <input type="text" name="link" id="">
                </div>
                <div class="form-control">
                    <label for="">Length</label>
                    <input type="number" max="6" min="4" name="length" id="">
                </div>

                <input type="submit" class="btn btn-sm btn-success" name="submit" id="">
            </form>
        </div>
    </div>

    @if(!empty($data))
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <th>No</th>
                        <th>URL</th>
                        <th>ShortUrl</th>
                        <th>Date Create</th>
                    </thead>
                    
                    <tbody>
                        @foreach ($data as $value)
                        <tr>
                            <td>1</td>
                            <td> {{ $value->longUrl }} </td>
                            <td> <a href="{{ route('url.redirect', $value->shortUrl) }}" target="_blank">{{ route('url.redirect', $value->shortUrl) }} </a> </td>
                            <td> {{ $value->created_at }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                        
                </table>
            </div>

        </div>
    @endif

@endsection