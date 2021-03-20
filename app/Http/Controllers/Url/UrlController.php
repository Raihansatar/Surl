<?php

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    public function index()
    {
        $data = ShortUrl::all();
        return view('homePage', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'length' => 'required'
         ]);

        $input['longUrl'] = $request->link;
        $input['shortUrl'] = Str::random($request->length);
   
        ShortUrl::create($input);
        
        return redirect('/')
        ->with('success', 'Shorten Link Generated Successfully!');
    }

    public function redirectUser($shortUrl)
    {
        $data = ShortUrl::where('shortUrl', $shortUrl)->first();
        return Redirect::away($data->longUrl);
    }
}
