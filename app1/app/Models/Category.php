<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $name
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name', 'species_id'
    ];

    protected $primaryKey = 'id';

    public $timestamps = null;

    private function species(): HasMany
    {
        return $this->hasMany('App\Models\Species', 'id', 'species_id');
    }

}
