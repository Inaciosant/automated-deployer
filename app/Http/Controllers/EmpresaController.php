<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        return response()->json(Empresa::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'foto_perfil' => 'nullable|string',
            'descricao' => 'nullable|string',
            'localizacao' => 'required|string|max:255',
        ]);

        Empresa::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Empresa cadastrada com sucesso!');
    }

    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return response()->json($empresa);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->only(['nome', 'foto_perfil', 'descricao', 'localizacao']));
        return redirect()->route('dashboard')->with('success', 'Empresa atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return redirect()->route('dashboard')->with('success', 'Empresa excluída com sucesso!');
    }
    
    public function dashboard(Request $request)
    {
        $empresas = \App\Models\Empresa::all();
        $editEmpresa = null;
        if ($request->has('edit')) {
            $editEmpresa = \App\Models\Empresa::find($request->input('edit'));
        }
        return view('dashboard', compact('empresas', 'editEmpresa'));
    }
}
