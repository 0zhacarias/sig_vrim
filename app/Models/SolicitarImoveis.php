<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitarImoveis extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table="solicitar_visitas";
    protected $guarded=['id'];

    public function usuario_marca_visita() {
       return $this->belongsTo(User::class,'user_marca_visita');
    }
}
