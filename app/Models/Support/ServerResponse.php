<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerResponse extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'method',
        'url',
        'headers',
        'status_code',
        'body',
        'client_request_id',
        'headers',
    ];
}
