<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class se5 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= [
        'E5_FILIAL'
        , 'E5_RECPAG'
        , 'E5_DATA'
        , 'E5_CODCAT'
        , 'E5_HISTORI'
        , 'E5_VALPAG'
        , 'E5_BANCO'
        , 'E5_AGENCIA'
        , 'E5_CONTA'
        , 'E5_NUMCHEQ'
        , 'E5_PESSOA'
        , 'E5_JUROS'
        , 'E5_MULTA'
        , 'E5_DESC'
        , 'E5_TPMOV'
        , 'E5_SITUACA'
        , 'E5_VALIRRF'
        , 'E5_ORDREC'
        , 'E5_DTDIGIT'
        , 'E5_MOVBCO'
        , 'E5_ARQCNAB'
        , 'E5_CNABOC'
        , 'E5_SERIE'
        , 'E5_NUM'
        , 'E5_PARCELA'
        , 'E5_TIPO'
        , 'E5_DTEXP'
        , 'E5_FILORIG'
        , 'E5_FLUXO'
        , 'E5_SEQUEN'
        , 'E5_LANPAD'
        , 'E5_DOCUMEN'
        , 'E5_SEQ'
        , 'E5_TIPODOC'
        , 'E5_CTRCOM'
        , 'E5_DTCRED'
        , 'D_E_L_E_T_'
        , 'R_E_C_N_O_'
        , 'E5_CTRTRN'
        , 'E5_ORIGEM'
        , 'E5_MSDT'
        , 'E5_MSAPPI'
        , 'E5_MSAPPA'
        , 'E5_MSUSRI'
        , 'E5_MSUSRA'
        , 'E5_FLYID'
        , 'E5_FLYUPD'
        , 'E5_FLYDEL'
    ];
    protected $primaryKey = 'R_E_C_N_O_';
    protected $table = 'SE5';

}
