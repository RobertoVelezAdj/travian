<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servidor extends Model
{
    use HasFactory;
    protected $table="construcciones";
    protected $primarykey="id";
    protected $fillable = ['nombre','ruta','ruta_inac','fch_creac','fch_mod'];
}
