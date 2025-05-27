@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Empresa</h1>
    <form method="POST" action="{{ route('empresas.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Localização</label>
            <input type="text" name="localizacao" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control">
        </div>
        <div class="mb-3">
            <label>Foto (URL)</label>
            <input type="text" name="foto_perfil" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection