@extends('layouts.model')
@section('content')

    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fa fa-handshake"></i> Pedidos
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('pedido.add')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>

    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <span class="fas fa-filter"></span> Filtros
    </button><p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="get" action="{{ route('pedido.listAll') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-2">
                        Pedido:
                        <input class="form-control" type="text" name="pedido" value="{{ array_key_exists('pedido',$dateForm) ? $dateForm['pedido'] : '' }}">
                    </div>
                    <div class="form-group col-md-2">
                        Pedido Cliente:
                        <input class="form-control" type="text" name="pedido_cliente" value="{{ array_key_exists('pedido_cliente',$dateForm) ? $dateForm['pedido_cliente'] : '' }}">
                    </div>
                    <div class="form-group col-md-3">
                        Data de:
                        <input class="form-control" type="date" name="dtI" value="{{ array_key_exists('dtI',$dateForm) ? $dateForm['dtI'] : date('Y-m-d', strtotime('-60 days')) }}">
                    </div>
                    <div class="form-group col-md-3">
                        Data até:
                        <input class="form-control" type="date" name="dtF" value="{{ array_key_exists('dtF',$dateForm) ? $dateForm['dtF'] : date('Y-m-d') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        Cliente:
                        <input class="form-control" type="text" name="cliente" value="{{ array_key_exists('cliente',$dateForm) ? $dateForm['cliente'] : '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        Status:
                        <select class="form-control" id="status" name="status">
                            <option value="t">Todos</option>
                            <option value="A">Abertos</option>
                            <option value="V">Vinculados</option>
                            <option value="F">Faturados</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>


    <table class="table table-bordered table-condensed table-striped fonte-10">
        <thead>
            <tr>
                <th width="10%">Pedido</th>
                <th width="10%">Pedido Cliente</th>
                <th width="20%">Cliente</th>
                <th width="10%">Valor</th>
                <th width="10%">Pedido A</th>
                <th width="10%">Pedido B</th>
                <th width="5%">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido )
                <tr>
                    <td align="center" class="verticalCenter">{!! $pedido->ID !!}</td>
                    <td align="center" class="verticalCenter">{!! $pedido->PEDIDO_CLIENTE !!}</td>
                    <td class="verticalCenter">{!! $pedido->A1_NOME !!}</td>
                    <td align="right" class="verticalCenter">{!! number_format($pedido->TOTAL,2,',','.') !!}</td>
                    <td align="center" class="verticalCenter"><input type="text" class="form-control semBorda fonte-10" id="NUM_PEDIDO_A" name="NUM_PEDIDO_A" pedido="{{$pedido->ID}}" value="{!! $pedido->NUM_PEDIDO_A !!}" ></td>
                    <td align="center" class="verticalCenter"><input type="text" class="form-control semBorda fonte-10" id="NUM_PEDIDO_B" name="NUM_PEDIDO_B" pedido="{{$pedido->ID}}" value="{!! $pedido->NUM_PEDIDO_B !!}" ></td>
                    <td>
                        <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('pedido.edit', $pedido->ID)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                {{-- <a class="dropdown-item" href="#">
                                    <form action=" {{ route('prodGrupo.destroy',['prodGrupo'=> $prodGrupo->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='prodGrupo' value=" {{ $prodGrupo->id }} ">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="btn btn-default delete"  value="Eliminar">
                                    </form>
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (isset($dateForm))
        {{$pedidos->appends($dateForm)->links()}}
    @else
        {{$pedidos->links()}}
    @endif
@endsection
