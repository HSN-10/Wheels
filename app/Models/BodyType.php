<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyType extends Model
{
    use HasFactory;


    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
