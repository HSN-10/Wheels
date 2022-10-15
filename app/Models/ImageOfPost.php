<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOfPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'post_id'
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
