@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Empresa</h1>
    <form method="POST" action="{{ route('empresas.update', $empresa->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $empresa->nome }}" required>
        </div>
        <div class="mb-3">
            <label>Localização</label>
            <input type="text" name="localizacao" class="form-control" value="{{ $empresa->localizacao }}" required>
        </div>
        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ $empresa->descricao }}">
        </div>
        <div class="mb-3">
            <label>Foto (URL)</label>
            <input type="text" name="foto_perfil" class="form-control" value="{{ $empresa->foto_perfil }}">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection