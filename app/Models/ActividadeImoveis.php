<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadeImoveis extends Model
{
    protected $table='actividade_imoveis';
    protected $guarded=['id'];
    use HasFactory;
}
