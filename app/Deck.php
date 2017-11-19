<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Slugify;

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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['link'];

    /**
     * Get the link.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        $slugify = new Slugify;

        return '/decks/' . $slugify->slugify( $this->attributes['title'] ) . '-' . $this->attributes['id'];
    }

    /**
     * Get User/Owner of the deck
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
