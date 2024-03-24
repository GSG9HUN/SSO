<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @property string $name
 * @property integer category_id
 * @property string hair_type
 */
class Species extends Model
{
    use HasFactory;

    protected $table = 'species';

    protected $fillable = [
        'name',
        'category_id',
        'hair_type'
    ];

    protected $primaryKey = 'id';

    public $timestamps = null;

    function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }


}
