<?php

namespace App\Repositories\Url;

use App\Interfaces\Url\UrlInterface;
use App\Models\click_count;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UrlRepository implements UrlInterface
{
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

    public function store($request)
    {
        // $request->validate([
        //     'link' => 'required|url',
        //     'length' => 'required'
        //  ]);

        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
            'length' => 'required'
        ]);

        if($validator->fails()){
            $data['type'] = 'danger';
            $data['message']= 'Wrong Input!';
            return response()->json($data);
        }
        
        $input['user_id'] = Auth::id();
        $input['longUrl'] = $request->link;
        $input['shortUrl'] = Str::random($request->length);
   
        ShortUrl::create($input);
        $data['type'] = 'success';
        $data['message']= 'Shorten Link Generated Successfully!';
        return response()->json($data);
        // return redirect('/')
        // ->with('success', 'Shorten Link Generated Successfully!');
    }

    public function getDatatable()
    {
        $data = ShortUrl::where('user_id', Auth::id())->get();
        return DataTables::of($data)
            ->editColumn('id', function ($row)
            {
                return 'X'.Auth::id().'F'.sprintf('%03d', $row->id);
                
            })
            ->editColumn('Url', function ($row)
            {
                $data = '<a href="'.$row->shortUrl.'" target="_blank">'.$row->longUrl.'</a>';
                return $data;
            })
            ->editColumn('ShortUrl', function ($row)
            {
                $data = '<a href="'.route('url.redirect', $row->shortUrl).'" target="_blank">'.route('url.redirect', $row->shortUrl).'</a>';
                return $data;
            })
            ->editColumn('DateCreated', function ($row)
            {
                return $row->created_at;
            })
            ->editColumn('action', function ($row)
            {
                $button = '<button class="btn btn-sm btn-danger mr-2 delete_url" data-id=" '.$row->id.'"> Delete </button>';
                return $button;
            })
            ->rawColumns(['Url', 'ShortUrl', 'action'])
            ->make(true);
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
    
    public function deleteUrl($request)
    {
        $data = ShortUrl::find($request->id);
        $data -> delete();

        $response['type'] = 'success';
        $response['message']= 'Delete Successfully!';
        return response()->json($response);
    }
}