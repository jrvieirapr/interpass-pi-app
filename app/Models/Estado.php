<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Estado extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'pais_id'];

    // public function pais()
    // {
    //     return $this->belongsTo(Pais::class, 'pais_id');
    // }

    // public function cidades()
    // {
    //     return $this->hasMany(Cidade::class);
    // }
}
