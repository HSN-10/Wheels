<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        // post details
        'title',
        'description',
        'price',
        'is_ask_price',
        'user_id',

        // car details
        'maker',
        'model',
        'colour',
        'years',
        'body_type_id',
        'transmission_tpye',
        'kilometrage',
        'gas_type',
        'doors',
        'engine_cylinders',
        'condition',
        'number_of_owners',
        'number_of_accidents'
    ];
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
