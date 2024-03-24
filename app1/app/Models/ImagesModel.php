<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Reedware\LaravelCompositeRelations\HasCompositeRelations;

class ImagesModel extends Model
{
    use HasFactory;
    use HasCompositeRelations;


    protected $table = 'animal';

    protected $fillable = [
        'animal_id','url'
    ];

    protected $primaryKeys = ['id','animal_id'];


    public $timestamps = null;

}
