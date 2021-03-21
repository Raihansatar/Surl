<?php

namespace App\Repositories\Url;

use App\Interfaces\Url\UrlInterface;
use App\Services\Url\DeleteUrlService;
use App\Services\Url\GetDatatableService;
use App\Services\Url\IndexService;
use App\Services\Url\RedirectUserService;
use App\Services\Url\StoreService;
use Exception;
use Illuminate\Support\Facades\Redirect;

class UrlRepository implements UrlInterface
{
    protected $indexServices, $storeService, $getDatatableService, $redirectUserService, $deleteUrlService;

    public function __construct(
        IndexService $indexService,
        StoreService $storeService,
        GetDatatableService $getDatatableService,
        RedirectUserService $redirectUserService,
        DeleteUrlService $deleteUrlService
    )
    {
        $this->indexServices = $indexService;
        $this->storeService = $storeService;
        $this->getDatatableService = $getDatatableService;
        $this->redirectUserService = $redirectUserService;
        $this->deleteUrlService = $deleteUrlService;
    }

    public function index()
    {
        $data = $this->indexServices->index();

        return $data;
        
    }

    public function store($request)
    {
        $data = $this->storeService->store($request);
        return $data;
        
    }

    public function getDatatable()
    {
        $data = $this->getDatatableService->getDatatable();

        return $data;
    }

    public function redirectUser($shortUrl)
    {
        try{
            $data = $this->redirectUserService->redirectUser($shortUrl);
            return Redirect::away($data->longUrl);
        }catch(Exception $e){
            return $e;
        }
        
    }
    
    public function deleteUrl($request)
    {

        try{
            $this->deleteUrlService->deleteUrl($request);
            $response['type'] = 'success';
            $response['message']= 'Delete Successfully!';
        }catch(Exception $e){
            $response['type'] = 'danger';
            $response['message']= 'Error, something wrong!';
        }
        
        return response()->json($response);
    }
}