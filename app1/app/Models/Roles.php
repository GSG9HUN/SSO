<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name', 'id'
    ];

    protected $primaryKey = 'id';

    const IS_ADMIN = 2;
    const IS_SUPER_ADMIN = 3;

}
