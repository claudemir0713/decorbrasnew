$(document).ready(function () {
    $(document).find('select').chosen();

    $(document).find('.primeiro').focus();

    /**********sempre que tabalhar com Ajax no Laravel tem que incluir essa tag *************/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /***********************colocando duas casas decimais************************************* */
    var decimal = $('.floatNumberField').attr('decimal');
    $('.floatNumberField').val(parseFloat($('.floatNumberField').val()).toFixed(decimal));

    $(".floatNumberField").on('change', function () {
        var decimal = $(this).attr('decimal');
        $(this).val(parseFloat($(this).val()).toFixed(decimal));
    });
    /**********************formata numero **************************************************/
    const formCurrency = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })


    /**********************formata cub **************************************************/
    const formM3 = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 3
    })

    /*************************pegando a url do servidor**************************************/

    url = $('input#appurl').val();

    /************************ buscaCep ******************************************************/
    $(document).on('blur', 'input#Cep', function (event) {
        event.preventDefault() // não permite que o navegador faça o submit
        var cep = $(this).val();
        var endereco = $('input#Ender').val().trim();
        if (endereco == '') {
            buscaCep(cep);
        };
    })

    /************************ buscaCnpj ******************************************************/
    $(document).on('blur', 'input#cnpj', function (event) {
        var cnpj = $(this).val().replace('.', '').replace('/', '').replace('-', '');

        if (cnpj.length >= 14) {
            buscaCnpj(cnpj);
        };
    })


    /***********************mensagem confirma exclusão **************************************/
    $(document).on('click', '.delete', function (event) {
        event.preventDefault()
        Swal({
            title: 'Deseja realmente excluir?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Remover'
        }).then((result) => {
            if (result.value) {
                var form = $(this).parent()
                form.submit()
            }
        });
    })

    /**********************gravar menu com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-menu', function (event) {
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = 'menu'

        var descricao = $(this).find('input#descricao').val();
        var tipo = $(this).find('select#tipo').val();
        var ordem = $(this).find('input#ordem').val();
        var rota = $(this).find('input#rota').val();
        var icone = $(this).find('input#icone').val();


        /********************************************************************************************* */
        if (!descricao || !tipo || !ordem) {
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer: 3000
            })
        } else {
            var dados = {
                'descricao': descricao
                , 'tipo': tipo
                , 'ordem': ordem
                , 'rota': rota
                , 'icone': icone
            }
            cadastrar(dados, route, type, origem);
        }
    })
    /***********************liberaMenu *****************************/
    $('#usuario').on('change',function(){
        liberaMenuDisponivel();
        removeMenuLiberado();
    })

    $(document).on('click','input.disponivel',function(event){
        if($(this).is(":checked")){
            var disponivelId = $(this).val();
            var usuario = $(document).find('#usuario').val();
            addMenuUsuario(disponivelId,usuario)
        }else{
            var liberadoId = $(this).val();
            removeMenuUsuario(liberadoId)
        }
    })
    $(document).on('click','button.liberado',function(event){
        var liberadoId = $(this).val();
        removeMenuUsuario(liberadoId)
    })


    /**********************AtivaInativaUsuario**************************************************/
    $(document).on('click','input.cliente_ativo',function(event){
        var usuario_id = $(this).val();
        var route = '/usuario/ativaUsuario'
        if($(this).is(":checked")){
            var ativo = 'S';
        }else{
            var ativo = 'N';
        }
        ativaUsuario(usuario_id,ativo,route)
    })
    /**********************AtivaInativaUsuario**************************************************/
    $(document).on('click','input.cliente_nivel',function(event){
        var usuario_id = $(this).val();
        var route = '/usuario/nivelUsuario'
        if($(this).is(":checked")){
            var ativo = 'adm';
        }else{
            var ativo = 'usuário';
        }
        // console.log(usuario_id,ativo,route);
        ativaUsuario(usuario_id,ativo,route)
    })


    /**********************gravar veiculo com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-veiculo', function (event) {
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = 'veiculo'

        var placa       = $(this).find('input#placa').val();
        var veiculo     = $(this).find('input#veiculo').val();
        var fornecedor  = $(this).find('select#fornecedor').val();
        var comprimento = $(this).find('input#comprimento').val();
        var largura     = $(this).find('input#largura').val();
        var altura      = $(this).find('input#altura').val();
        var cubagem     = $(this).find('input#cubagem').val();


        /********************************************************************************************* */
        if (!placa || !veiculo || !fornecedor || !comprimento || !largura || !altura || !cubagem) {
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer: 3000
            })
        } else {
            var dados = {
                'placa': placa
                , 'veiculo': veiculo
                , 'fornecedor': fornecedor
                , 'comprimento': comprimento
                , 'largura': largura
                , 'altura': altura
                , 'cubagem': cubagem
            }
            cadastrar(dados, route, type, origem);
        }
    })

    /**********************buscaNomeProdutoDimensao **************************************************/
    $(document).on('blur', '.pro_cod', function (event) {
        event.preventDefault()
        var pro_cod = $(this).val();
        var Key = $(this).attr("id").replace(/\D/g, '');
        buscaNomeProdutoDimensao(pro_cod,Key)
    })

    /**********************calcula m3 **************************************************/
    $(document).on('change', '.qtd', function (event) {
        event.preventDefault()
        var qtd = parseFloat($(this).val());
        var Key = $(this).attr("id").replace(/\D/g, '');

        var comprimento = parseFloat($(document).find('#comprimento'+Key).val())
        var largura     = parseFloat($(document).find('#largura'+Key).val())
        var espessura   = parseFloat($(document).find('#espessura'+Key).val())
        var m3 = qtd * (comprimento/1000) * (largura/1000) * (espessura/1000)
        m3 = formM3.format(m3);
        m3 = m3.replace('R$','');
        $(document).find('#m3'+Key).val(m3)
    })

    /**********************calcula totalItem **************************************************/
    $(document).on('change', '.unt', function (event) {
        event.preventDefault()
        var unt = parseFloat($(this).val().replace('.','').replace(',','.'));
        var Key = $(this).attr("id").replace(/\D/g, '');

        var qtd = parseFloat($(document).find('#qtd'+Key).val().replace('.','').replace(',','.'))
        var total = qtd * unt
        total = formCurrency.format(total);
        total = total.replace('R$','');
        $(document).find('#total'+Key).val(total)
        somaTotalItens();
        somaM3lItens();

    })
    /**********************calcula unt **************************************************/
    $(document).on('change', '.total', function (event) {
        event.preventDefault()
        var total = parseFloat($(this).val().replace('.','').replace(',','.'));
        var Key = $(this).attr("id").replace(/\D/g, '');

        var qtd = parseFloat($(document).find('#qtd'+Key).val().replace('.','').replace(',','.'))
        var unt = total / qtd
        unt = formCurrency.format(unt);
        unt = unt.replace('R$','');
        $(document).find('#unt'+Key).val(unt)

        somaTotalItens();
        somaM3lItens();
    })
    /**********************calcula totalItem pela qtd **************************************************/
    $(document).on('change', '.qtd', function (event) {
        event.preventDefault()
        var qtd = parseFloat($(this).val().replace('.','').replace(',','.'));
        var Key = $(this).attr("id").replace(/\D/g, '');

        var unt = parseFloat($(document).find('#unt'+Key).val().replace('.','').replace(',','.'))
        var total = qtd * unt
        if(isNaN(total)){
            total = 0
        }
        total = formCurrency.format(total);
        total = total.replace('R$','');
        $(document).find('#total'+Key).val(total)
        somaTotalItens();
        somaM3lItens();

    })


    /**********************abre busca Produto **************************************************/
    $(document).on('keydown', '.pro_cod', function (event) {
        if(event.which == 113) {
            var nomeCampo = $(this).attr('id');
            document.getElementById('btn_modal_produto').click()
            $(document).find('#nomeCampo').val(nomeCampo);
        }
    })


    /*******************verifica informações do cliente ao colocar o pedido de venda */
    $(document).on('change','#cliente',function(event){
        consultaObsCliente()
        consultaCreditoCliente()
        consultaCliente();
    })

    /***************localiza produto ********************************************************************/
    $(document).on('click','#btn_localizar',function(){
        listaProduto()
    })

    $(document).on('click','.btn_seleciona_produto',function(){
        var cod_prod = $(this).val().trim();
        var nomeCampo = $(document).find('#nomeCampo').val().trim()
        $(document).find('#'+nomeCampo).val(cod_prod);
        document.getElementById('fecha_modal').click()
        $(document).find('#'+nomeCampo).focus();
    })

})


