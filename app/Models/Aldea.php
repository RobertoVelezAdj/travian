<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aldea extends Model
{
    use HasFactory;
    protected $table="aldea";
    protected $primarykey="id";
    protected $fillable = ['coord_x','coord_y','puntos_cultura','madera','barro','hierro','ceral','id_cuenta','tipo','fiesta_grande','fiesta_pequena','fch_creac','fch_mod','nombre'];
}
