<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sex extends Model
{
    use HasFactory;

    protected $table = 'sex';

    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'id';

    public $timestamps = null;

    private function animal(): BelongsTo
    {
        return $this->belongsTo('App\Models\Animal', 'sex_id', 'id');
    }
}
