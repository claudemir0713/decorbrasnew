<?php

namespace App\Http\Controllers\pedido;

use App\Http\Controllers\Controller;
use App\Models\planner_pedido;
use App\Models\sa1;
use App\Models\sb1;
use App\Models\planner_sb1_dimensoes;
use App\Models\se6;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class pedidoController extends Controller
{
    public function listAll (Request $request)
    {
        $dateForm = $request->except('_token');
        $filtros=[];
        if(array_key_exists('pedido',$dateForm)){
            if($dateForm['pedido']){
                $filtros[]=['PLANNER_PEDIDO.ID','=',$dateForm['pedido']];
            }
        };
        if(array_key_exists('pedido_cliente',$dateForm)){
            if($dateForm['pedido_cliente']){
                $filtros[]=['PLANNER_PEDIDO.PEDIDO_CLIENTE','=',$dateForm['pedido_cliente']];
            }
        };
        if(array_key_exists('dtI',$dateForm)){
            if($dateForm['dtI']){
                $filtros[]=['PLANNER_PEDIDO.DATA','>=',$dateForm['dtI']];
            }
        };
        if(array_key_exists('dtF',$dateForm)){
            if($dateForm['dtF']){
                $filtros[]=['PLANNER_PEDIDO.DATA','<=',$dateForm['dtF']];
            }
        };

        if(array_key_exists('cliente',$dateForm)){
            if($dateForm['cliente']){
                $filtros[]=['SA1.A1_NOME','like','%'.$dateForm['cliente'].'%'];
            }
        };
        // DB::connection()->enableQueryLog();
        $pedidos  = planner_pedido::select([
                                    'PLANNER_PEDIDO.ID'
                                    , 'PLANNER_PEDIDO.FILIAL'
                                    , 'PLANNER_PEDIDO.NUM'
                                    , 'PLANNER_PEDIDO.PESSOA'
                                    , 'PLANNER_PEDIDO.ESPECIE'
                                    , 'PLANNER_PEDIDO.PEDIDO_CLIENTE'
                                    , 'PLANNER_PEDIDO.DATA'
                                    , 'PLANNER_PEDIDO.EMBALAGEM'
                                    , 'PLANNER_PEDIDO.VENDEDOR'
                                    , 'PLANNER_PEDIDO.COND_PGTO'
                                    , 'PLANNER_PEDIDO.NUM_PEDIDO_A'
                                    , 'PLANNER_PEDIDO.NUM_PEDIDO_B'
                                    , 'A1_NOME'
                                    ,  DB::raw("SUM(TOTAL) AS TOTAL")
                                ])
                                ->leftJoin('SA1', function ($join){
                                    $join->on('SA1.A1_PESSOA','=','PLANNER_PEDIDO.PESSOA');
                                })
                                ->leftJoin('PLANNER_PEDIDO_ITENS','PLANNER_PEDIDO_ITENS.ID_PEDIDO','=','PLANNER_PEDIDO.ID')
                                ->where($filtros)
                                ->where('SA1.D_E_L_E_T_','<>','*')
                                ->where('SA1.A1_FILIAL','LIKE','01%')

                                ->groupBy([
                                    'PLANNER_PEDIDO.ID'
                                    , 'PLANNER_PEDIDO.FILIAL'
                                    , 'PLANNER_PEDIDO.NUM'
                                    , 'PLANNER_PEDIDO.PESSOA'
                                    , 'PLANNER_PEDIDO.ESPECIE'
                                    , 'PLANNER_PEDIDO.PEDIDO_CLIENTE'
                                    , 'PLANNER_PEDIDO.DATA'
                                    , 'PLANNER_PEDIDO.EMBALAGEM'
                                    , 'PLANNER_PEDIDO.VENDEDOR'
                                    , 'PLANNER_PEDIDO.COND_PGTO'
                                    , 'PLANNER_PEDIDO.NUM_PEDIDO_A'
                                    , 'PLANNER_PEDIDO.NUM_PEDIDO_B'
                                    , 'A1_NOME'
                                ])
                                ->orderBy('ID','desc')
                                ->paginate(10);
        // $queries = DB::getQueryLog();
        // dd($queries);

        return view('pedido.listAll', compact('pedidos','dateForm'));
    }

    public function add ()
    {
        $clientes = sa1::where('D_E_L_E_T_','<>','*')
                        ->where('A1_CLIENTE','S')
                        ->orderBy('A1_NOME')
                        ->get([
                            'A1_PESSOA'
                            ,'A1_NOME'
                        ]);
        $vendedores = sa1::where('D_E_L_E_T_','<>','*')
                        ->where('A1_VEND','S')
                        ->orderBy('A1_NOME')
                        ->get([
                            'A1_PESSOA'
                            ,'A1_NOME'
                        ]);
        $cod_pagto = se6::where('D_E_L_E_T_','<>','*')
                        ->orderBy('E6_DESCRI')
                        ->get([
                            'E6_CODCND'
                            , 'E6_DESCRI'
                        ]);

        return view('pedido.add',compact('clientes','vendedores','cod_pagto'));
    }

    public function buscaNomeProdutoDimensao(Request $request)
    {
        $produtos = sb1::select(['sb1.B1_CODPROD', 'sb1.B1_DESCRI','B1_COMPRIMENTO', 'B1_LARGURA', 'B1_ESPESSURA'])
                        ->leftJoin('planner_sb1_dimensoes', function($join){
                            $join->on('planner_sb1_dimensoes.B1_CODPROD','=','sb1.B1_CODPROD');
                        })
                        ->where('sb1.D_E_L_E_T_','<>','*')
                        ->where('sb1.B1_FILIAL', 'LIKE', '01%')
                        ->where('sb1.B1_CODPROD', '=', $request->pro_cod)
                        ->first();
        return response()->json($produtos);

    }

    public function Store (Request $request)
    {

    }

    public function edit ($id)
    {

    }

    public function update ($id, Request $request)
    {

    }

    public function destroy ($id)
    {

    }
    public function consultaCliente(Request $request)
    {
        $cod_cli = $request->cod_cli;
        $Cliente = sa1::select([
                        DB::raw('ltrim(rtrim(A1_NOME)) as A1_NOME')
                        ,DB::raw('ltrim(rtrim(A1_CEP)) as A1_CEP')
                        ,DB::raw('ltrim(rtrim(A1_END)) as A1_END')
                        ,DB::raw('ltrim(rtrim(A1_BAIRRO)) as A1_BAIRRO')
                        ,DB::raw('ltrim(rtrim(A1_MUN)) as A1_MUN')
                        ,DB::raw('ltrim(rtrim(A1_EST)) as A1_EST')
                        ,DB::raw('ltrim(rtrim(A1_VENDE1)) as A1_VENDE1')
                    ])
                    ->where('A1_PESSOA','=',$cod_cli)
                    ->where('A1_CLIENTE','=','S')
                    ->where('D_E_L_E_T_','<>','*')
                    ->where('A1_ATIVO','=','1')
                    ->where('A1_FILIAL','=','01')
                    ->first();
        return response()->json($Cliente);
    }
    public function consultaObsCliente(Request $request)
    {
        $cod_cli = $request->cod_cli;
        $obsCliente = sa1::select(DB::raw('cast(cast(A1_OBSERV as varbinary(max)) as varchar(max)) as OBSERVACAO'))
                    ->where('A1_PESSOA','=',$cod_cli)
                    ->where('A1_CLIENTE','=','S')
                    ->where('D_E_L_E_T_','<>','*')
                    ->where('A1_ATIVO','=','1')
                    ->where('A1_FILIAL','=','01')
                    ->first();
        return response()->json($obsCliente->OBSERVACAO);
    }

    public function consultaCreditoCliente(Request $request)
    {
        $cod_cli = $request->cod_cli;

        $sql="
            select
                sum(VALOR) as VALOR
                ,sum(QTD)  as QTD
            from(
                SELECT
                    coalesce(sum(E1_SALDO),0) AS VALOR
                    ,count(*)   as QTD
                FROM SE1
                WHERE se1.D_E_L_E_T_<>'*'
                AND E1_SALDO >0
                AND E1_PESSOA = '$cod_cli'
                AND convert(date,E1_VENCTO) < getdate()

                UNION ALL
                SELECT
                coalesce(sum(Z28_VALOR),0) AS VALOR
                ,count(*)   as QTD

                FROM Z28
                LEFT JOIN SA1 ON  LEFT(SA1.A1_FILIAL,2) = LEFT(Z28.Z28_FILIAL,2)
                            AND SA1.A1_PESSOA = Z28.Z28_PESSOA
                            AND SA1.D_E_L_E_T_<>'*'
                WHERE Z28.D_E_L_E_T_<>'*'
                AND Z28_STATUS IN(1,2,5)
                AND  Z28_PESSOA = '$cod_cli'
            AND convert(date,Z28_DATA) < getdate()
            )dados
        ";
        $saldo = DB::select($sql);
        return response()->json($saldo);
    }

    public function listaProduto(Request $request)
    {
        $nome_produto = $request->produto;
        $produto = sb1::select(['B1_FILIAL', 'B1_CODPROD', 'B1_DESCRI'])
                    ->where('D_E_L_E_T_','<>','*')
                    ->where('B1_DESCRI','like','%'.$nome_produto.'%')
                    ->get();
        return response()->json($produto);
    }
}
