<?php

namespace App\Services\Url;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexService {
    public function index()
    {
        if(Auth::check()){
            if(User::find(Auth::id())->hasVerifiedEmail()){
                $data = ShortUrl::where('user_id', Auth::id())->get();
                $name = Auth::user()->name;
                return view('homePage', compact('data', 'name'));
            }else{
                return redirect()->route('verification.notice')->with('info', 'Please check your email for verification.');
            }
        }else{
            return view('homePage');
        }
    }
}