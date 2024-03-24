<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $county_id
 * @property mixed $name
 */
class Settlement extends Model
{
    use HasFactory;

    protected $table = 'settlement';

    protected $fillable = [
        'name',
        'county_id'
    ];

    protected $primaryKey = 'id';

    public $timestamps = null;

    function shelter(): BelongsTo
    {
        return $this->belongsTo('App\Models\Shelter', 'settlement_id', 'id');
    }

    function county(): BelongsTo
    {
        return $this->belongsTo('App\Models\County','county_id','id');
    }
}
