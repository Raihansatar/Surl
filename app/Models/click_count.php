<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class click_count extends Model
{
    use HasFactory;

    protected $fillable = [
        'click_url_id',
        'browser',
        'location',
        'ip_address'
    ];
}
