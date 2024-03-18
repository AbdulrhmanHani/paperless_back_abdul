<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'event_id',
        'status',
        'email_base64',
        'token',
        // add invitation link (url) & in api file to check if it's opened or not
    ];

}
