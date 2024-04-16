<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class markinfo extends Model
{
    use HasFactory;
    protected $connection = 'oracle4';
    protected $table = 'bibliomark.mark';
}
