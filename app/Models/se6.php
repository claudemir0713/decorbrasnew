<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class se6 extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable= [
        'E6_FILIAL'
        , 'E6_CODCND'
        , 'E6_TIPO'
        , 'E6_DESCTP'
        , 'E6_DESCRI'
        , 'E6_DDD'
        , 'E6_CHEQ'
        , 'E6_SOLID'
        , 'E6_IPI'
        , 'E6_VLRMIN'
        , 'E6_UMOVME'
        , 'E6_MSEXP'
        , 'E6_UMOVINT'
        , 'E6_UMOVID'
        , 'E6_UMOVATV'
        , 'D_E_L_E_T_'
        , 'R_E_C_N_O_'
        , 'E6_COND'
        , 'E6_IPDV'
        , 'E6_IPDVINT'
        , 'E6_IPDVID'
        , 'E6_IPDVATV'
        , 'E6_IPDVCHV'
        , 'E6_MSDT'
        , 'E6_QTDPARC'
        , 'E6_MSAPPI'
        , 'E6_MSAPPA'
        , 'E6_MSUSRI'
        , 'E6_MSUSRA'
        , 'E6_GUID'
        , 'E6_FLYID'
        , 'E6_FLYUPD'
        , 'E6_FLYDEL'
    ];
    protected $primaryKey = 'R_E_C_N_O_';
    protected $table = 'SE6';
}
