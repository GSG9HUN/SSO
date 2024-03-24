<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shelter extends Model
{
    use HasFactory;

    protected $table = 'shelter';

    protected $fillable = [
        'name', 'phone_number', 'settlement_id', 'street', 'house_number', 'animal_id', 'user_id'
    ];

    protected $primaryKey = 'id';

    public $timestamps = null;

    private function settlement(): HasOne
    {
        return $this->hasOne('App\Models\Settlement', 'id', 'settlement_id');
    }

    private function animal(): HasMany
    {
        return $this->hasMany('App\Models\Animal', 'id', 'animal_id');
    }
}
