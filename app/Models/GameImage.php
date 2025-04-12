<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameImage extends Model
{
    use HasFactory;

    protected $table = 'game_images';

    protected $fillable = [
        'admin_id',
        'game_id',
        'image',
        'display_on_home',
        'sort_order'
    ];


//     public function game()
//     {
//         return $this->belongsTo(Game::class);
//     }

//     public function image()
// {
//     return $this->hasMany(GameImage::class);
// }
}
