<?php

namespace App\Models;

use App\Models\Category;
use App\Models\GardenFlower;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flower extends Model
{
    protected $fillable = ['title', 'price', 'img', 'category_id','use_time_water','descrip'];

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function gardens()
    {
        return $this->belongsTo(GardenFlower::class, 'flower_id', 'id');
    }
}
