<?php

namespace App\Interfaces\Url;


interface UrlInterface {
    public function index();

    public function store($request);

    public function getDatatable();

    public function redirectUser($shortUrl);

    public function deleteUrl($request);

}