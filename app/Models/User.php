<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'oracle';
    protected $table = 'workflow.ptouser';
    protected $primarykey = 'iduser';
    //protected $keyType = 'string';
    //public $incrementing = false;

    public function login():BelongsTo{

        return $this->belongsTo(login::class,'idcustomer','defaultcustomerid');

    }

    public function username()
    {
       return 'login';
    }

    protected $fillable = [
        //'login',
        'login',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
