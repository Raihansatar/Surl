<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function index()
    {
        return view('verify.main');
    }

    public function verification(EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/');
    }

    public function sendVerification(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('info', 'Verification link sent!');
    }
}
