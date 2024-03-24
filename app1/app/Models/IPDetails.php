<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string $country_name
 * @property mixed|string $religion_name
 * @property mixed|string $city_name
 * @property mixed|string $ip
 * @property mixed|string $connected_at
 */
class IPDetails extends Model
{
    use HasFactory;

    protected $table = 'ip_location';

    protected $fillable = [
        'ip','country_name','region_name','city_name','connected_at'
    ];

    protected $primaryKey = 'id';
    public $timestamps = null;
}
