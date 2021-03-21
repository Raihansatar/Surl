<?php

namespace App\Services\Url;

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GetDatatableService {
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
}