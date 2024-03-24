<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animal';

    protected $fillable = [
        'name', 'category_id', 'sex_id', 'size_id', 'color_id', 'age', 'description', 'mix'
    ];

    protected $primaryKey = 'id';


    public $timestamps = null;


    private function category(): HasOne
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    private function sex(): HasOne
    {
        return $this->hasOne('App\Models\Sex', 'id', 'sex_id');
    }

    private function size(): HasOne
    {
        return $this->hasOne('App\Models\Size', 'id', 'size_id');
    }

    private function color(): HasOne
    {
        return $this->hasOne('App\Models\Color', 'id', 'color_id');
    }

}
