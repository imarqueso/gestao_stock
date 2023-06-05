<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = "notas";
    protected $fillable = ['cpf', 'cliente', 'itens', 'qtd_itens', 'data_venda', 'observacoes', 'total'];
}
