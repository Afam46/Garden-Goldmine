<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Flower;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    protected $fillable = ['title'];
    public $timestamps = false;

    public function flowers(){
        return $this->hasMany(Flower::class);
    }
}
