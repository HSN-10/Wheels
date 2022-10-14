<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function body_type()
    {
        return $this->belongsTo(BodyType::class);
    }
    public function post_type()
    {
        return $this->belongsTo(PostType::class);
    }
    public function images()
    {
        return $this->hasMany(ImageOfPost::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function counter_offers()
    {
        return $this->hasMany(CounterOffer::class);
    }
}
