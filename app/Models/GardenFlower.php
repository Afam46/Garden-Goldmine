<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GardenFlower extends Model
{
    protected $table = 'garden_flowers';

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'title','price','stage','category_id','user_id','time',
        'use_time_water', 'img', 'descrip'
    ];

}   