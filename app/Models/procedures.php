<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class procedures extends Model
{
    use HasFactory;
    protected $connection = 'oracle3';
    protected $table = 'PROCEDURES.PTOPROCEDURE';
    protected $primaryKey = 'nrproc';
    protected $keyType = 'string';
}
