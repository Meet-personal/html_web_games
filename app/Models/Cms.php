<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;
    protected $table='cms_pages';
    protected $fillable=[
        'admin_id',
        'country_id',
        'slug',
        'title',
        'content',
        'status'
    ];


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
