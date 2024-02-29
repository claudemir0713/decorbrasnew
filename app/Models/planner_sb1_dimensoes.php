<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planner_sb1_dimensoes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= [
        'B1_FILIAL'
        , 'B1_CODPROD'
        , 'B1_COMPRIMENTO'
        , 'B1_LARGURA'
        , 'B1_ESPESSURA'
    ];
    protected $primaryKey = ['B1_FILIAL', 'B1_CODPROD'];
    protected $table = 'PLANNER_SB1_DIMENSOES';
}




