@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Empresas</h1>
    <a href="{{ route('empresas.create') }}" class="btn btn-primary mb-3">Cadastrar Empresa</a>
    <ul class="list-group">
        @foreach($empresas as $empresa)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $empresa->nome }}</strong> - {{ $empresa->localizacao }}
            </div>
            <div>
                <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection