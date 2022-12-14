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
        'negotiable',
        'image',
        'user_id',

        // car details
        'maker',
        'model',
        'colour',
        'years',
        'body_type_id',
        'transmission_type',
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
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function favorite()
    {
        return $this->hasOne(Favorite::class);
    }
    public function counter_offers()
    {
        return $this->hasMany(CounterOffer::class);
    }
}
