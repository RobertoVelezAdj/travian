<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class construcciones extends Model
{
    use HasFactory;
    protected $table="construcciones";
    protected $primarykey="id";
    protected $fillable = ['tipo','subTipo','nombre_ed','enlace','nivel','madera','barro','hierro','ceral','consumo','pc','produccion','created_at','updated_at'];
}
