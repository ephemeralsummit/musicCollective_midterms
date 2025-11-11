<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'artist_id', 'image', 'spotify', 'bandcamp', 'soundcloud'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
