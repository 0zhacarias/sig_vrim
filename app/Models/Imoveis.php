<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imoveis extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="imoveis";
    protected $guarded=['id'];
public function categoria() {
    return $this->belongsTo(Categoria::class);
}
public function tipologiaImoveis() {
    return $this->belongsTo(Tipologia::class);
}
public function usuario(){
    return $this->belongsTo(User::class,'created_by');
}
public function estadoImovel(){
    return $this->belongsTo(EstadoImoveis::class);
}
public function fotosImoveis(){
    return $this->belongsTo(FotosImoveis::class,'imoveis_id');
}
}
