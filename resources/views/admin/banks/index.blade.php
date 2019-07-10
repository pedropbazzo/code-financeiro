@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <br>

            <div class="clearfix">
                <div class="left">
                    <h5>Listagem de bancos</h5>
                </div>
                <div class="right">
                    <a href="{{route('admin.banks.create')}}" class="btn waves-effect right">Novo banco</a>
                </div>
            </div>

            <br>
            <br>

            <table class="bordered striped highlight centered responsive-table z-depth-5">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banks as $bank)
                <tr>
                    <td>{{ $bank->id }}</td>
                    <td>{{ $bank->name }}</td>
                    <td>
                        <a href="{{ route('admin.banks.edit', ['bank' => $bank->id]) }}" class="btn waves-effect">Editar</a>
                        <delete-action action="{{route('admin.banks.destroy',['bank'=>$bank->id])}}" action-element="link-delete-{{$bank->id}}" csrf-token="{{csrf_token()}}">
                            <?php
                                $modalId = "modal-delete-$bank->id";
                                $deleteRoute = route('admin.banks.destroy',['bank'=> $bank->id]);
                            ?>
                            <a id="link-modal-{{$bank->id}}" href="#{{$modalId}}" class="btn waves-effect">Excluir</a>
                                <modal :modal="{{json_encode(['id'=>$modalId])}}" style="display: none">
                                    <div slot="content">
                                        <h5>Mensagem de confirmação</h5>
                                        <p><strong>Deseja excluir esse banco?</strong></p>
                                        <div class="divider"></div>
                                        <p>Nome: <strong>{{$bank->name}}</strong></p>
                                        <div class="divider"></div>
                                    </div>
                                    <div slot="footer">
                                        <button id="link-delete-{{$bank->id}}" class="btn waves-effect modal-close modal-action">Ok</button>
                                        <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                                    </div>
                                </modal>
                        </delete-action>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="center-align">
                {!! $banks->links() !!}
            </div>
        </div>

    </div>
@endsection