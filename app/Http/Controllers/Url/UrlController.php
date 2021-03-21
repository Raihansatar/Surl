<?php

namespace App\Http\Controllers\Url;

use App\Http\Controllers\Controller;
use App\Interfaces\Url\UrlInterface;
use Illuminate\Http\Request;


class UrlController extends Controller
{

    protected $urlInterfaces;

    public function __construct(UrlInterface $urlInterfaces)
    {
        $this->urlInterfaces = $urlInterfaces;
    }

    public function index()
    {
        $data = $this->urlInterfaces->index();
        return $data;
    }

    public function store(Request $request)
    {
        $data = $this->urlInterfaces->store($request);
        return $data;
    }

    public function getDatatable()
    {
        $data = $this->urlInterfaces->getDatatable();
        return $data;
        
    }

    public function redirectUser($shortUrl)
    {

        $data = $this->redirectUser($shortUrl);
        return $data;
    }
    
    public function deleteUrl(Request $request)
    {
        $data = $this->urlInterfaces->deleteUrl($request);
        return $data;
    }
}
