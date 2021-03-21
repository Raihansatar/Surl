@extends('layouts.main')

@section('contents')
    @include('panels.flash-message')
    <div class="card">
        <div class="card-header">
            Welcome, please sign in
        </div>
        
        <div class="card-body">
            <form action="{{ route('login.attempt') }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data" id="loginform">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email <span style="color: red">*</span> </label>
                        <input class="form-control" type="email" name="email" id="email" required>
                        <div class="invalid-feedback">
                            Email is required
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password <span style="color: red">*</span></label>
                        <input class="form-control" type="password" name="password" id="password" required>
                        <div class="invalid-feedback">
                            Password is required
                        </div>
    
                    </div>
                    

                <input type="submit" class="btn btn-sm btn-success" name="signin" id="signin">
                <a href="{{ route('register.signup') }}">First time? Register here</a>
            </form>
        </div>
    </div>
@endsection


@push('custom-js')
    <script>
    $('document').ready(function(){

        (function () {
        'use strict'
    
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
    
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }
    
                form.classList.add('was-validated')
            }, false)
            })
        })()
    })


    </script>
    
@endpush

