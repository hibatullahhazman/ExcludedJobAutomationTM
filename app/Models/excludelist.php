<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class excludelist extends Model
{
    use HasFactory;
    protected $connection = 'oracle3';
    protected $table = 'PROCEDURES.EXCLUDEAUTOMATION';
    protected $primaryKey = 'nrproc';
    protected $keyType = 'string';
    public $incrementing = false;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'IDPROC',
        'NRPROC',
    ];

    /**
     * Get the user that owns the excludelist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function markinfo(): BelongsTo
    {
        return $this->belongsTo(markinfo::class, 'idapplication', 'nrproc');
    }

    public function definition(): BelongsTo
    {
        return $this->belongsTo(definition::class, 'idstatus', 'currentstatusid');
    }

    public function procedures(): BelongsTo
    {
        return $this->belongsTo(procedures::class, 'nrproc', 'nrproc');
    }

}
