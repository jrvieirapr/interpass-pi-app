<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['nomeEvento','dataEvento','localEvento','qtIngresso','cidade_id'];

    public function cidade(){
        return $this->belongsTo(Cidade::class);
    }

    public function ingressos(){

        return $this->hasMany(Ingressos::class, 'cidade_id');
    }

}
