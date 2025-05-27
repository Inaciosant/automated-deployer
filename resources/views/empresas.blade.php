<!DOCTYPE html>
<html>
<head>
    <title>Empresas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="mb-4">Empresas</h1>
    <form method="POST" action="{{ url('/empresas') }}" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col"><input type="text" name="nome" class="form-control" placeholder="Nome" required></div>
            <div class="col"><input type="text" name="localizacao" class="form-control" placeholder="Localização" required></div>
            <div class="col"><input type="text" name="descricao" class="form-control" placeholder="Descrição"></div>
            <div class="col"><input type="text" name="foto_perfil" class="form-control" placeholder="Foto (URL)"></div>
            <div class="col-auto"><button type="submit" class="btn btn-primary">Cadastrar</button></div>
        </div>
    </form>
    <ul class="list-group">
        @foreach($empresas as $empresa)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <strong>{{ $empresa->nome }}</strong> - {{ $empresa->localizacao }}
                </span>
                <form method="POST" action="{{ url('/empresas/'.$empresa->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>