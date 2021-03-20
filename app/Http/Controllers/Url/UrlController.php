<?php

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Models\click_count;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function index()
    {
        if(Auth::check()){
            $data = ShortUrl::where('user_id', Auth::id())->get();
            $email = Auth::user()->email;
            return view('homePage', compact('data', 'email'));
        }else{
            return view('homePage');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'length' => 'required'
         ]);
        
        $input['user_id'] = Auth::id();
        $input['longUrl'] = $request->link;
        $input['shortUrl'] = Str::random($request->length);
   
        ShortUrl::create($input);
        
        return redirect('/')
        ->with('success', 'Shorten Link Generated Successfully!');
    }

    public function redirectUser($shortUrl)
    {

        $data = ShortUrl::where('shortUrl', $shortUrl)->first();
        click_count::create([
            'click_url_id' => $data->id,
            // 'browser' => '',
            // 'location' => "",
            // 'ip_address' => "",
        ]);
        return Redirect::away($data->longUrl);
    }
}
