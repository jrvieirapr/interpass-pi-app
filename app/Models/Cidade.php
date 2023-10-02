<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cidades(){
        return $this->hasMany(Cidade::class);
    }

    public function eventos(){
        return $this->hasMany(Evento::class);
    }

}
