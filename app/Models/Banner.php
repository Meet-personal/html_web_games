<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';
    protected $fillable = [
        'admin_id',
        'category_id',
        'game_id',
        'type',
        'title',
        'description',
        'image',
        'status',
        'sort_order',
        'url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
