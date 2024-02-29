@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-handshake"></i> Pedido</h3>
    <form action="" id="cadastro-menu" nome="cadastro-menu" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/pedido/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="pedido">

        <div class="row">
            <div class="form-group col-md-4">
                Cliente:
                <select class="form-control" id="cliente" name="cliente">
                    <option value="">Selecione</option>
                    @foreach ($clientes as $item )
                        <option value="{!! $item->A1_PESSOA !!}">{!! $item->A1_NOME !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Espécie:
                <input class="form-control" name="especie" type="text" id="especie" value="" maxlength="10">
            </div>
            <div class="form-group col-md-2">
                Data:
                <input class="form-control" type="date" name="data" id="data" value="{!! date('Y-m-d') !!}">
            </div>
            <div class="form-group col-md-2">
                Cond.Pgto:
                <select class="form-control" id="cond_pgto" name="cond_pgto">
                    <option value="">Selecione</option>
                    @foreach ($cod_pagto as $pgto )
                        <option value="{!! $pgto->E6_CODCND !!}">{!! $pgto->E6_DESCRI !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Embalagem:
                <select class="form-control" name="embalagem" id="embalagem">
                    <option value="">Selecione</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="T">Troca</option>
                    <option value="X">Bonificação</option>
                    <option value="Y">PD</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                Vendedor:
                <select class="form-control" id="vendedor" name="vendedor">
                    <option value="">Selecione</option>
                    @foreach ($vendedores as $item )
                        <option value="{!! $item->A1_PESSOA !!}">{!! $item->A1_NOME !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Pedido Cliente:
                <input class="form-control" name="ped_cli" type="text" id="ped_cli" value="">
            </div>
            <div class="form-group col-md-2">
                Frete:
                <select class="form-control" name="frete" id="frete">
                    <option value="CIF">CIF</option>
                    <option value="FOB">FOB</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                Valor:
                <input class="form-control" type="text" name="vl_frete" id="vl_frete" value="0,00" >
            </div>
            <div class="form-group col-md-2">
                Incluso?:
                <select class="form-control" name="FRETE_INCLUSO" id="FRETE_INCLUSO">
                    <option value="N" selected="selected">Não</option>
                    <option value="S">Sim</option>
                </select>
            </div>
        </div><hr>
        <div class="row">
            <div class="form-group col-md-12">
                Pedido Relacionado
            </div>
            <div class="form-group col-md-2">
                <input class="form-control" name="NUN_PEDIDO_RELACIOANDO" type="text" id="NUN_PEDIDO_RELACIOANDO" value="" size="10" maxlength="10">
            </div>
            <div class="form-group col-md-2">
                <input class="form-control" name="NUN_PEDIDO_RELACIOANDO2" type="text" id="NUN_PEDIDO_RELACIOANDO2" value="" size="10" maxlength="10">
            </div>
            <div class="form-group col-md-2">
                <input class="form-control" name="NUN_PEDIDO_RELACIOANDO3" type="text" id="NUN_PEDIDO_RELACIOANDO3" value="" size="10" maxlength="10">
            </div>
            <div class="form-group col-md-2">
                <input class="form-control" name="NUN_PEDIDO_RELACIOANDO4" type="text" id="NUN_PEDIDO_RELACIOANDO4" value="" size="10" maxlength="10">
            </div>
        </div><hr>
        <div class="row">
            <div class="form-group col-md-12">
                Obs Prod.:
                <textarea class="form-control" name="obs" cols="80" rows="3" id="obs"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                Obs Nota:
                <textarea class="form-control" name="obs_nf" cols="80" rows="3" id="obs_nf"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                Obs Cliente:
                <textarea class="form-control" name="obs_cli" cols="80" rows="3" id="obs_cli"></textarea>
            </div>
        </div><hr>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="card" >
                    <div class="card-header" align="center">
                        Itens do Pedido
                    </div>
                    <div class="card-header">
                        <div class="row fonte-10"  style="height: 40px;" align="center">
                            <div class="form-group col-md-6" >
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        Produtos
                                    </div>
                                    <div class="form-group col-md-6">
                                        Dimensões
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        Cod:
                                    </div>
                                    <div class="form-group col-md-4">
                                        Descrição:
                                    </div>
                                    <div class="form-group col-md-2">
                                        Compr.:
                                    </div>
                                    <div class="form-group col-md-2">
                                        Larg.:
                                    </div>
                                    <div class="form-group col-md-2">
                                        Espes.:
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 verticalCenter" >
                                <div class="row">
                                    <div class="form-group col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        Qtd
                                    </div>
                                    <div class="form-group col-md-2">
                                        Unt
                                    </div>
                                    <div class="form-group col-md-2">
                                        M³
                                    </div>
                                    <div class="form-group col-md-3">
                                        Total
                                    </div>
                                    <div class="form-group col-md-3">
                                        #
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body SemFundo">
                        <div id="sectionItem">
                            <div class="sectionItem">
                                <div class="row" style="height: 25px;">
                                    <div class="form-group col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10 pro_cod" type="text" id="pro_cod" name="pro_cod[]" value="">
                                                <button class="btn_modal_produto" id="btn_modal_produto"  data-toggle="modal" data-target="#modalProduto" data-backdrop="static" data-keyboard="false" hidden></button>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input class="form-control fonte-10 " type="text" id="produto" name="produto[]" value="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10" type="text" id="comprimento" name="comprimento[]" value="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10" type="text" id="largura" name="largura[]" value="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10" type="text" id="espessura" name="espessura[]" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10 qtd" type="text"  id="qtd" name="qtd[]" value="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10 unt" type="text"  id="unt" name="unt[]" value="">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input class="form-control fonte-10" type="text" id="m3" name="m3[]" value="" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <input class="form-control fonte-10 total" type="text"  id="total" name="total[]" value="">
                                            </div>
                                            <div class="form-group col-md-1"  align="center">
                                                <button type="button" name="add-Servico[]" id="addItem" value="" class="btn btn-outline-primary addsectionItem fas">
                                                    <span class="fas fa-plus"></span>
                                                </button>
                                            </div>
                                            <div class="form-group col-md-1"  align="center">
                                                <button type="button" name="delServico" id="minusItem" value="" class="btn btn-outline-danger removeItem fas">
                                                    <span class="fas fa-minus"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div><hr>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row fonte-10"  style="height: 40px;" align="center">
                            <div class="form-group col-md-6" >
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {{-- <div class="form-control">Total</div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6" >
                                <div class="row">
                                    <div class="form-group col-md-4">

                                    </div>
                                    <div class="form-group col-md-2">
                                        <input class="form-control fonte-10" type="text"  id="totalM3" name="totalM3" value="">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <input class="form-control fonte-10" type="text"  id="totalGeral" name="totalGeral" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="" id="salvar" class="btn btn-success btn-block">
                    <span class="fas fa-save"></span> Salvar
                </button>
            </div>
                <div class="form-group col-md-3">
                    <button type="button" name="sair" id="sair" value="" class="btn btn-danger btn-block">
                        <span class="fa fa-door-open"></span> Sair
                    </button>
                </div>
            </div>
        </div>
    </form>
    @include('pedido.modalProduto')
    <script>
        $(document).ready(function(){

            $('button#sair').click(function(){
                $(location).attr('href',url+'/pedido');
            })
        })

    /******************************** clone Item ******************************/
        var templateItem = $('#sectionItem .sectionItem:first').clone();
        //clear inputs
        templateItem.find("select").val('');
        templateItem.find("input").val('');

        //define counter
        var sectionsCountItem = $(document).find('.sectionItem').length;
        //add new section
        $('body').on('click', '.addsectionItem', function() {
            //increment
            sectionsCountItem++;
            //loop through each input
            var section = templateItem.clone().find(':input').each(function(){
                //set id to store the updated section number
                var newIdItem = this.id + sectionsCountItem;
                //update for label
                $(this).prev().attr('for', newIdItem);
                //update id
                this.id = newIdItem;

            }).end()

            //inject new section
            .appendTo('#sectionItem');
            colocaChosen();

            return false;
        });

        //remove section
        $('#sectionItem').on('click', '.removeItem', function() {
            var id = $(this).attr("id").replace(/[^\d]+/g,'');
            var  acao = 'del';
            if($(document).find('.sectionItem').length>1){
                $(this).parent().fadeOut(300, function(){
                    //remove parent element (main section)
                    $(this).parent().parent().parent().parent().remove();
                    return false;
                })
            }
            return false;
        });

    </script>

@endsection
