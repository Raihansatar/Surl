<?php

namespace App\Services\Url;

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StoreService {
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
            'length' => 'required'
        ]);

        if($validator->fails()){
            $data['type'] = 'danger';
            $data['message']= 'Wrong Input!';
            return response()->json($data);
        }else{
            $input['user_id'] = Auth::id();
            $input['longUrl'] = $request->link;
            $input['shortUrl'] = Str::random($request->length);
       
            ShortUrl::create($input);
            $data['type'] = 'success';
            $data['message']= 'Shorten Link Generated Successfully!';
            return response()->json($data);
        }
    }
}