<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class definition extends Model
{
    use HasFactory;
    protected $connection = 'oracle5';
    protected $table = 'definitions.bbastatusclassif';
}
