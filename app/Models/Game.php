<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;


    protected $table = 'games';

    protected $fillable = [
        'admin_id',
        'category_id',
        'slug',
        'name',
        'url',
        'description',
        'image',
        'status',
        'display_on_home',
        'sort_order',
        'keyword',
        'flag',
        'vertical_image'
    ];

    public function gameImages()
    {
        return $this->hasMany(GameImage::class, 'game_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function game()
    {
        return $this->hasMany(Game::class); // Adjust as necessary
    }


}
