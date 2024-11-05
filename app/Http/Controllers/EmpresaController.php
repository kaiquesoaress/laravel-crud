<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        return Empresa::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:empresas',
            'endereco' => 'required|string',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'celular' => 'required|string',
        ]);

        return Empresa::create($request->all());
    }

    public function show($id)
    {
        return Empresa::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:empresas,cnpj,' . $empresa->id,
            'endereco' => 'required|string',
            'email' => 'required|email',
            'telefone' => 'required|string',
            'celular' => 'required|string',
        ]);

        $empresa->update($request->all());
        return $empresa;
    }

    public function destroy($id)
    {
        Empresa::destroy($id);
        return response()->noContent();
    }
}
