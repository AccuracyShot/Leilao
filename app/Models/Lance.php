<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lance extends Model
{
    use HasFactory;

    protected $fillable = ['leilao_id', 'valor', 'usuario_id'];

    public function leilao()
    {
        return $this->belongsTo(Leilao::class); // Relacionamento "Um para um" com Leilão
    }

    public function participante()
    {
        return $this->belongsTo(User::class);
    }

}
