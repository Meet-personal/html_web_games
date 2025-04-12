<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'counrty_code',
        'mobile_number',
        'profile_photo',
        'password',
        'admin_id'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
