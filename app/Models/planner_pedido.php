<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planner_pedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= [
        'ID'
        ,'FILIAL'
        ,'NUM'
        ,'PESSOA'
        ,'ESPECIE'
        ,'PEDIDO_CLIENTE'
        ,'DATA'
        ,'EMBALAGEM'
        ,'VENDEDOR'
        ,'COND_PGTO'
        ,'NUM_PEDIDO_A'
        ,'NUM_PEDIDO_B'
        ,'TIPO_FRETE'
        ,'VALOR_FRETE'
        ,'FRETE_INCLUSO'
        ,'OBS'
        ,'OBS_NF'
        ,'NUN_PEDIDO_RELACIOANDO'
        ,'NUN_PEDIDO_RELACIOANDO_2'
        ,'NUN_PEDIDO_RELACIOANDO_3'
        ,'NUN_PEDIDO_RELACIOANDO_4'
        ,'FRETE_NR_CONHECIMENTO'
        ,'FRETE_OBS'
        ,'FRETE_VLR'
        ,'OBS_PAPELETA'

    ];
    protected $primaryKey = 'ID';
    protected $table = 'PLANNER_PEDIDO';
}
