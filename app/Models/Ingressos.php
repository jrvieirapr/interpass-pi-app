<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingressos extends Model
{
    use HasFactory;

    protected $fillable = ['chaveIngresso','evento_id','dataEmissao','cliente_id', 'metodoPagamento', 'valorCompra'];

    public function evento()
    {
        return $this->belongsTo(Evento::class, "evento_id");
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, "cliente_id");
    }

}
