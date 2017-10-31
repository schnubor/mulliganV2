<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'format', 'decklist', 'user_id', 'views', 'likes', 'tags', 'colors', 'wip', 'cardcount'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
