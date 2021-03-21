@extends('layouts.main')

@section('contents')
    @include('panels.flash-message')

    <div class="card card-custom">
        <div class="card-body p-25">
            <form class="form" action="{{ route('verification.send') }}" method="POST" novalidate="novalidate" id="resendEmailForm">
                @csrf
                <div class="text-center pb-8">
                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Resend Email Verification</h2>
                    <p class="text-muted font-weight-bold font-size-h4">Resend Now ?</p>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                        type="email" placeholder="Email" name="email" value="{{ auth()->user()->email }}" autocomplete="off" disabled />
                </div>
                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                    <button type="submit" id="register" class="btn btn-primary ">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection