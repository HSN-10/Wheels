<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodyType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon'
    ];

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
