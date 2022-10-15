<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        // alert details
        'price_from',
        'price_to',
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
}
