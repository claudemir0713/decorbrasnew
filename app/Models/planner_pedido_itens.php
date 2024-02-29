<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planner_pedido_itens extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= [
        'ID_PEDIDO'
        , 'ID_ITENS'
        , 'FILIAL'
        , 'COD_PROD'
        , 'DESCRICAO'
        , 'UND'
        , 'LARGURA'
        , 'COMPRIMENTO'
        , 'ESPESSURA'
        , 'QTD'
        , 'UNT'
        , 'TOTAL'
    ];
    protected $primaryKey = ['ID_PEDIDO', 'ID_ITENS'];
    protected $table = 'PLANNER_PEDIDO_ITENS';
}
