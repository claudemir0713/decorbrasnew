/**********************formata numero **************************************************/
const formCurrency = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL',
    minimumFractionDigits: 2
})

/********************* busca cep cliente *****************************************/
function buscaCep(cep){
    $.ajax({
        data: {cep:cep},
        type: 'POST',
        dataType: 'JSON',
        url:url+'/clientes/buscaCep',
        beforeSend: function(){

        },
        success: function(result)
        {
            $('#Mun').val(result.localidade);
            $('#Ender').val(result.logradouro);
            $('#Bairro').val(result.bairro);
            $('#Uf').val(result.uf);
        }
    });

}
function colocaChosen(){
    $(document).find('select').chosen();
}

/*****************************busca cnpj*****************************************/
function buscaCnpj(cnpj){
    $.ajax({
        data: {cnpj:cnpj},
        type: 'POST',
        dataType: 'JSON',
        url:url+'/clientes/buscaCnpj',
        beforeSend: function(){
            Swal({
                title: 'Aguarde consultado dados!',
                type: 'warning',
                timer:2000
            })
        },
        success: function(result)
        {
            $('input#nome').val(result.nome);
            $('input#cep').val(result.cep);
            $('input#telefone').val(result.telefone);
            $('input#cidade').val(result.municipio);
            $('input#email').val(result.email);
            $('input#endereco').val(result.logradouro+','+result.numero);
            $('input#bairro').val(result.bairro);
            $('input#uf').val(result.uf);

        }
    });
}

/***********************************cadastrar************************************ */
function cadastrar(dados,route,type,origem){
    var title = 'Cadastro alterado com sucesso!';
    if(type == 'POST'){
        title = 'Cadastro efetuado com sucesso!';
    }
    var tipo = 'success';
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            if(result!="success"){
                title="Cadastro não efetuado";
                tipo = 'error';
            }
            $('.limpar').val('');
            $(document).find('.primeiro').focus();
            $('select').trigger("chosen:updated");
            Swal({
                title: title,
                type: tipo,
                timer:1000
            })

            if(origem=='processo'){
                window.location.replace(url+'/'+origem);
            };
            if(tipo=='success' && origem!='modelo'){
                if(type != 'POST'){
                    window.location.replace(url+'/'+origem);
                }
            };
        },
        complete: function(){
            $('#salvar').prop("disabled",false);
        }
    })
}

function liberaMenuDisponivel()
{
    var usuario = $(document).find('#usuario').val();
    var dados = {
        'usuario': usuario
    };
    var route = '/menu/disponivel'
    var linhas = '';
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        beforeSend : function(){
            linhas = '';
            $('#menuDisponivel').html('');
            swal({
                title: 'Aguarde!',
                type: 'warning',
                html: '<strong>Efetuando busca</strong>',
                onOpen: () => {
                    swal.showLoading()
                }
            })
        },
        success: function (result) {
            linhas = '';
            classe = '';
            $.each(result, function (i, val) {
                if(val.tipo=='Título'){
                    classe='negrito';
                }else{
                    classe='paragrafo';
                };
                var id = 0;
                (val.selecionado=="checked")?id = val.selecionadoId : id=val.disponivelId
                linhas += '<tr>';
                    linhas += '<td class="'+classe+'"><button class="btn btn-link" value="'+val.disponivelId+'">'+val.ordem+'-'+val.descricao+'</button></td>';
                    linhas += '<td>';
                        linhas += '<label class="switch" >';
                            linhas += '<input type="checkbox" class="disponivel" id="protrang" name="protrang" '+val.selecionado+' value="'+id+'">';
                            linhas += '<span class="slider round"></span>';
                        linhas += '</label>';
                    linhas += '</td>';
                linhas += '</tr>';
            })

        },
        complete:function(){
            $('#menuDisponivel').html(linhas);
            swal.close();
        }
    })
}

function removeMenuLiberado()
{
    var usuario = $(document).find('#usuario').val();
    var dados = {
        'usuario': usuario
    };
    var route = '/menu/menuLiberado'
    var linhas = '';
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        beforeSend : function(){
            linhas = '';
            $('#menuLiberado').html('');
            swal({
                title: 'Aguarde!',
                type: 'warning',
                html: '<strong>Efetuando busca</strong>',
                onOpen: () => {
                    swal.showLoading()
                }
            })
        },
        success: function (result) {
        },
        complete:function(){
            $('#menuLiberado').html(linhas);
            swal.close();
        }
    })
}

function addMenuUsuario(disponivelId,usuario){
    var dados = {
        'usuario': usuario,
        'disponivelId' : disponivelId
    };
    var route = '/menu/addMenuUsuario'
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        complete:function(){
            liberaMenuDisponivel();
            removeMenuLiberado();
        }
    })
}
function removeMenuUsuario(liberadoId){
    var dados = {
        'liberadoId' : liberadoId
    };
    var route = '/menu/removeMenuUsuario'
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        complete:function(){
            liberaMenuDisponivel();
            removeMenuLiberado();
        }
    })
}


function ativaUsuario(usuario_id,etapa_id,route){
    var dados = {
        'usuario_id': usuario_id,
        'etapa_id' : etapa_id
    };
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route
    })
}

function buscaNomeProdutoDimensao(pro_cod,Key){
    var dados = {
        'pro_cod': pro_cod,
        'Key' : Key
    };
    var type = 'POST'
    var route = '/pedido/buscaNomeProdutoDimensao'
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            $(document).find('#produto'+Key).val(result.B1_DESCRI);
            $(document).find('#comprimento'+Key).val(result.B1_COMPRIMENTO);
            $(document).find('#largura'+Key).val(result.B1_LARGURA);
            $(document).find('#espessura'+Key).val(result.B1_ESPESSURA);
        }
    })
}

function consultaObsCliente(){
    var cod_cli = $('#cliente').val()
    var dados = {
        'cod_cli': cod_cli
    };
    var type = 'POST'
    var route = '/pedido/consultaObsCliente'
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {

            if(result!='[object Object]'){
                $(document).find('#obs_cli').val(result);
            }else{
                $(document).find('#obs_cli').val('');
            }
        }
    })
}


function consultaCliente(){
    var cod_cli = $('#cliente').val()
    var dados = {
        'cod_cli': cod_cli
    };
    var type = 'POST'
    var route = '/pedido/consultaCliente'
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            $(document).find('#vendedor').val(result.A1_VENDE1).trigger("chosen:updated");;
        }
    })
}

function consultaCreditoCliente(){
    var cod_cli = $('#cliente').val()
    var dados = {
        'cod_cli': cod_cli
    };
    var type = 'POST'
    var route = '/pedido/consultaCreditoCliente'
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            if(result[0].VALOR>0){
                swal({
                    title: "Atenção!",
                    type: "warning",
                    text: "Cliente com "+result[0].QTD+" títulos em atraso!! "+formCurrency.format(result[0].VALOR)+""
                });
            }
        }
    })
}

function listaProduto(){
    var produto = $(document).find('#produto_loc').val()
    var dados = {
        'produto': produto
    };
    var type = 'POST'
    var route = '/pedido/listaProduto'
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            var linhas = '';
            linhas +='<tr>'
            linhas +='<td width="20%">#</td>'
            linhas +='<td width="20%">Código</td>'
                linhas +='<td width="60%">Descrição</td>'
            linhas +='</tr>'

            $.each(result,  function (i, val) {
                linhas +='<tr>';
                    linhas +='<td>';
                        linhas += '<button type="button" class="btn btn-success fa fa-check btn_seleciona_produto" value="'+val.B1_CODPROD+'"></button>'
                    linhas +='</td>';
                    linhas +='<td>';
                        linhas += val.B1_CODPROD
                    linhas +='</td>';
                    linhas +='<td>';
                        linhas += val.B1_DESCRI
                    linhas +='</td>';
                linhas +='</tr>';

            })
            $(document).find('div#lista_produtos').html(linhas)
        }
    })
}
function somaTotalItens(){
    totalGeral = 0;
    $('input.total').each(function(){
        var valorTotal =$(this).val().replaceAll('.','').replaceAll(',','.');
        if(isNaN(valorTotal)){
            valorTotal = 0
        }
        valorTotal = parseFloat(valorTotal);
        totalGeral+=valorTotal
        console.log(totalGeral)
    })
    totalGeral = formCurrency.format(totalGeral);
    totalGeral = totalGeral.replace('R$','');

    $(document).find('#totalGeral').val(totalGeral)
}
function somaM3lItens(){
    totalM3 = 0;
    $('input.m3').each(function(){
        var m3 =$(this).val().replaceAll('.','').replaceAll(',','.');
        console.log(m3);
        if(isNaN(m3)){
            m3 = 0
        }
        m3 = parseFloat(m3);
        totalM3+=m3
    })
    totalM3 = formCurrency.format(totalM3);
    totalM3 = totalM3.replace('R$','');

    $(document).find('#totalM3').val(totalM3)

}
