<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


final class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $keyType = 'string';

    protected $primaryKey = 'id_admin';

    protected $table = 'admin';

    protected $fillable = [
        'nama',
        'email',
        'role',
        'password',
    ];

    protected $guarded = [
        'id_admin',

    ];

    protected $hidden = [
        'password',
    ];

    private string $guard = 'admin';
}

