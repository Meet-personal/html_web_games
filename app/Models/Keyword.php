<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $table = 'game_keyword';

    protected $fillable = [

        'game_id',
        'game_keyword',

    ];


    public function games()
    {
        return $this->belongsTo(game::class);
    }
}
