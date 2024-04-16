<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aktiviti extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'aktiviti';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user',
        'nrproc',
        'activity_code',
        'status',
        'created_at',
    ];

}
