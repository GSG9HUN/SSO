<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $name
 */
class Size extends Model
{
    use HasFactory;

    protected $table = 'size';

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'id';

    public $timestamps = null;

    private function animal(): BelongsTo
    {
        return $this->belongsTo('App\Models\Animal', 'size_id', 'id');
    }
}
