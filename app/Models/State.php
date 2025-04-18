<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table='states';

    protected $fillable = [
       'admin_id',
       'country_id',
        'state',
        'code',
        'status',
    ];


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
