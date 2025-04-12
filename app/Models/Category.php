<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,
        SoftDeletes;
    protected $table = 'categories';

    protected $fillable = [
        'admin_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'status',
        'display_on_home',
        'sort_order'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function games()
    {
        return $this->hasMany(Game::class ,'category_id', 'id');
    }

}
