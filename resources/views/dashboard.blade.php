<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-bold mb-6 text-indigo-700">Empresas</h3>

                {{-- Alerta de sucesso --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded bg-green-100 text-green-800 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Formulário de cadastro/edição --}}
                <div class="mb-8">
                    @if(isset($editEmpresa) && $editEmpresa)
                        <h4 class="text-lg font-semibold mb-2 text-blue-700">Editar Empresa</h4>
                        <form method="POST" action="{{ route('empresas.update', $editEmpresa->id) }}" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nome da Empresa</label>
                                <input type="text" name="nome" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nome', $editEmpresa->nome) }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Localização</label>
                                <input type="text" name="localizacao" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('localizacao', $editEmpresa->localizacao) }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                                <input type="text" name="descricao" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('descricao', $editEmpresa->descricao) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Foto (URL)</label>
                                <input type="text" name="foto_perfil" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('foto_perfil', $editEmpresa->foto_perfil) }}">
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Atualizar</button>
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Cancelar</a>
                            </div>
                        </form>
                    @else
                        <h4 class="text-lg font-semibold mb-2 text-green-700">Cadastrar Empresa</h4>
                        <form method="POST" action="{{ route('empresas.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nome da Empresa</label>
                                <input type="text" name="nome" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nome') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Localização</label>
                                <input type="text" name="localizacao" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('localizacao') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                                <input type="text" name="descricao" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('descricao') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Foto (URL)</label>
                                <input type="text" name="foto_perfil" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('foto_perfil') }}">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                                Salvar
                            </button>
                        </form>
                    @endif
                </div>

                <hr class="my-6">

                {{-- Lista de empresas em cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($empresas as $empresa)
                    <div class="bg-gray-50 rounded shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                        @if($empresa->foto_perfil)
                            <img src="{{ $empresa->foto_perfil }}" class="w-full h-44 object-cover" alt="Foto da empresa">
                        @else
                            <div class="w-full h-44 bg-gray-200 flex items-center justify-center text-gray-400">Sem Imagem</div>
                        @endif
                        <div class="p-4 flex-1 flex flex-col">
                            <h5 class="text-lg font-bold text-indigo-700">{{ $empresa->nome }}</h5>
                            <p class="text-gray-600 mb-2">{{ $empresa->descricao }}</p>
                            <p class="text-sm text-gray-500 mb-4">{{ $empresa->localizacao }}</p>
                            <div class="mt-auto flex gap-2">
                                <a href="{{ route('dashboard', ['edit' => $empresa->id]) }}" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition text-sm">Editar</a>
                                <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" onsubmit="return confirmDelete(this);" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Script para confirmação estilizada --}}
                <script>
                    function confirmDelete(form) {
                        return confirm('Tem certeza que deseja excluir esta empresa?');
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
