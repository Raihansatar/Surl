@extends('layouts.main')

@section('contents')
    @include('panels.flash-message')
    @auth
        <div class="card">
            <div class="card-header">
                Welcome {{ $email }}, paste the URL to be shortened
            </div>

            
            <div class="card-body">
                <form action="{{ route('url.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Link</label>
                            <input class="form-control" type="text" name="link" id="link">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Length</label>
                            <input class="form-control" type="number" max="6" min="4" name="length" id="length">
                        </div>


                    <input type="submit" class="btn btn-sm btn-success" name="submit" id="submit">
                </form>
            </div>
        </div>

        
        @if(!empty($data))
        <div class="pt-4">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover" id="surl-datatable">
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

        </div>
        @endif
    @endauth

    @guest
        <div class="card">
            <div class="card-header">
                Welcome, please register to use our app.
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
                </form>
            </div>
        </div>
    @endguest
@endsection

@push('custom-js')
    <script>
        $('document').ready(function(){
            $('#surl-datatable').DataTable({
                "responsive": true
            });
        })
    </script>
@endpush