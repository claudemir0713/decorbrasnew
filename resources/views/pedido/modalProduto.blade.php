<div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="modalProdutoLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel panel-primary">
                <div class="panel-heading bg-primary text-white">
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="ModalInsercaoLabel">Produto:</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <input type="hidden" class="form-control" name="nomeCampo" id="nomeCampo" value="">
                    <div class="row">
                        <div class="form-group col-md-10">
                            Produto:
                            <input type="text" class="form-control" id="produto_loc" name="produto_loc" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <br>
                            <button type="button" class="btn btn-success fa fa-check" id="btn_localizar"></button>
                        </div>
                    </div>
                    <div class="form-group col-md-10">
                        <table class="table table-bordered">
                            <div id="lista_produtos"></div>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group col-md-4">
                    <button type="button" class="btn  btn-sm btn-danger btn-block" id="fecha_modal" data-dismiss="modal"><i class="fa fa-times"></i>  Sair</button>
                </div>
            </div>
        </div>
    </div>
</div>

