<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class se3 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= [
        'E3_FILIAL'
        , 'E3_PESSOA'
        , 'E3_NUM'
        , 'E3_SERIE'
        , 'E3_PARCELA'
        , 'E3_DTCOMIS'
        , 'E3_BASE'
        , 'E3_PORC'
        , 'E3_COMISS'
        , 'E3_DATA'
        , 'E3_NUMCOM'
        , 'E3_FILORIG'
        , 'E3_CTRCOM'
        , 'E3_PRODUTO'
        , 'E3_CLIENTE'
        , 'E3_TIPO'
        , 'E3_ORIGEM'
        , 'E3_TITORIG'
        , 'E3_SERORIG'
        , 'E3_PARORIG'
        , 'E3_ITEM'
        , 'E3_FILSF1'
        , 'E3_DOCSF1'
        , 'E3_SERSF1'
        , 'E3_PESSF1'
        , 'E3_MOTIVO'
        , 'D_E_L_E_T_'
        , 'R_E_C_N_O_'
        , 'E3_PORC2'
        , 'E3_MSDT'
        , 'E3_MSAPPI'
        , 'E3_MSAPPA'
        , 'E3_MSUSRI'
        , 'E3_MSUSRA'
    ];
    protected $primaryKey = 'R_E_C_N_O_';
    protected $table = 'SE3';

}
