<?php

namespace App\Services\Url;

use App\Models\ShortUrl;

class DeleteUrlService {
    public function deleteUrl($request)
    {
        $data = ShortUrl::find($request->id);
        $result = $data -> delete();
        return $result;
    }
}