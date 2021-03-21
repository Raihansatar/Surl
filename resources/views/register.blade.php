@extends('layouts.main')

@section('contents')
    @include('panels.flash-message')
    <div class="card">
        <div class="card-header">
            Welcome, please register to use our app.
        </div>

        <div class="card-body">
            <form action="{{ route('register.signup') }}" method="POST" id="registerForm" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name <span style="color: red">*</span></label>
                        <input class="form-control" type="name" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email <span style="color: red">*</span></label>
                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password <span style="color: red">*</span></label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password <span style="color: red">*</span></label>
                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" required>
                        <span style="color: red" id="invalid_confirm_password"></span>
                    </div>
                <input type="submit" class="btn btn-sm btn-success" name="signin" id="signin">
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
            
            var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
            $('#registerForm').submit(function(e){
                password.onchange = validatePassword(e);
                confirm_password.onkeyup = validatePassword;
            })

            $('#confirm_password').change(function(e){
                password.onchange = validatePassword(e);
                confirm_password.onkeyup = validatePassword;
            })

            $('#password').change(function(e){
                password.onchange = validatePassword(e);
                confirm_password.onkeyup = validatePassword;
            })

            function validatePassword(e){
                if(password.value != confirm_password.value) {
                    $('#invalid_confirm_password').html("Passwords Don't Match");
                    // confirm_password.html("Passwords Don't Match");
                    e.preventDefault();
                } else {
                    // confirm_password.html('');
                    $('#invalid_confirm_password').html("");

                }
            }

        })

    </script>
@endpush