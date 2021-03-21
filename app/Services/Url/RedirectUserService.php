<?php

namespace App\Services\Url;

use App\Models\click_count;
use App\Models\ShortUrl;

class RedirectUserService {
    public function redirectUser($shortUrl)
    {
        $data = ShortUrl::where('shortUrl', $shortUrl)->first();
        click_count::create([
            'click_url_id' => $data->id,
            // 'browser' => '',
            // 'location' => "",
            // 'ip_address' => "",
        ]);

        return $data;
    }
}