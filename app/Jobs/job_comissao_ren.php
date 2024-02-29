<?php

namespace App\Jobs;

use App\Models\se1;
use App\Models\se3;
use App\Models\se5;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class job_comissao_ren implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $data = se5::where('E5_RECPAG','R')->where('E5_SERIE','REN')->max('E5_DTDIGIT');
        $baixas = se5::leftJoin('SE3','SE3.E3_CTRCOM','SE5.E5_CTRCOM')
                        ->where('E5_RECPAG','R')
                        ->where('E5_SERIE','REN')
                        ->whereNull('E3_NUM')
                        ->where('se5.E5_DTDIGIT','>=','20240101')
                        ->get();
        foreach($baixas as $baixa){
            $e1 = se1::where('E1_FILIAL',$baixa->E5_FILIAL)
                    ->where('E1_NUM',$baixa->E5_NUM)
                    ->where('E1_PARCELA',$baixa->E5_PARCELA)
                    ->where('E1_TIPO',$baixa->E5_TIPO)
                    ->where('E1_PESSOA',$baixa->E5_PESSOA)
                    ->where('E1_SERIE',$baixa->E5_SERIE)
                    ->first();

            // $e5_ctrcom = $baixa->E5_CTRCOM;
            // $e3_ctrcom = se3::where('e3_ctrcom',$e5_ctrcom)->where('D_E_L_E_T_','<>','*')->first();
            $R_E_C_N_O_ = se3::max('R_E_C_N_O_')+1;
            try{
                $se3 = new se3([
                    'E3_FILIAL'     =>$baixa->E5_FILIAL
                    , 'E3_PESSOA'   =>$e1->E1_VEND1
                    , 'E3_NUM'      =>$baixa->E5_NUM
                    , 'E3_SERIE'    =>$baixa->E5_SERIE
                    , 'E3_PARCELA'  =>$baixa->E5_PARCELA
                    , 'E3_DTCOMIS'  =>$baixa->E5_DATA
                    , 'E3_BASE'     =>$baixa->E5_VALPAG
                    , 'E3_PORC'     =>$e1->E1_COMIS1
                    , 'E3_COMISS'   =>$baixa->E5_VALPAG * ($e1->E1_COMIS1/100)
                    , 'E3_DATA'     =>''
                    , 'E3_NUMCOM'   =>''
                    , 'E3_FILORIG'  =>$baixa->E5_FILORIG
                    , 'E3_CTRCOM'   =>$baixa->E5_CTRCOM
                    , 'E3_PRODUTO'  =>''
                    , 'E3_CLIENTE'  =>''
                    , 'E3_TIPO'     =>'V'
                    , 'E3_ORIGEM'   =>'B'
                    , 'E3_TITORIG'  =>''
                    , 'E3_SERORIG'  =>''
                    , 'E3_PARORIG'  =>''
                    , 'E3_ITEM'     =>''
                    , 'E3_FILSF1'   =>''
                    , 'E3_DOCSF1'   =>''
                    , 'E3_SERSF1'   =>''
                    , 'E3_PESSF1'   =>''
                    , 'R_E_C_N_O_'  => $R_E_C_N_O_
                    , 'D_E_L_E_T_'  =>''
                    , 'E3_PORC2'    =>0
                    , 'E3_MSDT'     =>$baixa->E5_MSDT
                    , 'E3_MSAPPI'   =>''
                    , 'E3_MSAPPA'   =>''
                    , 'E3_MSUSRI'   =>''
                    , 'E3_MSUSRA'   =>''
                ]);
                // dd($se3);
                $se3->save();
            }catch(\Exception $e){
                dd($e);
            };
        }
    }
}
