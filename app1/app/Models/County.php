<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $name
 */
class County extends Model
{
    use HasFactory;

    protected $table = 'county';

    protected $fillable = ['name'];

    protected $primaryKey = 'id';

    public $timestamps = null;


    function settlement(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Settlement','settlement');
    }
}
