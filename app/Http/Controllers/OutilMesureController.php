<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutilMesureController extends Controller
{
    public function index()
    {
        $outils = DB::table('outilmesure')
            ->join('parametres', 'outilmesure.id_para', '=', 'parametres.id_para')
            ->select('outilmesure.*', 'parametres.titre as parametre_titre')
            ->get();

        return view('outil-mesure.index', compact('outils'));
    }

    public function create()
    {
        $parametres = DB::table('parametres')->get();
        return view('outil-mesure.create', compact('parametres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idot' => 'required|string|max:50|unique:outilmesure,idot',
            'nom' => 'required|string|max:100',
            'id_para' => 'required|exists:parametres,id_para'
        ]);

        DB::table('outilmesure')->insert([
            'idot' => $validated['idot'],
            'nom' => $validated['nom'],
            'id_para' => $validated['id_para'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('outil-mesure.index')
            ->with('success', 'Outil de mesure créé');
    }

    public function show($id)
    {
        $outil = DB::table('outilmesure')
            ->join('parametres', 'outilmesure.id_para', '=', 'parametres.id_para')
            ->where('outilmesure.idot', $id)
            ->select('outilmesure.*', 'parametres.titre as parametre_titre')
            ->first();

        return view('outil-mesure.show', compact('outil'));
    }

    public function edit($id)
    {
        $outil = DB::table('outilmesure')->where('idot', $id)->first();
        $parametres = DB::table('parametres')->get();
        return view('outil-mesure.edit', compact('outil', 'parametres'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'id_para' => 'required|exists:parametres,id_para'
        ]);

        DB::table('outilmesure')->where('idot', $id)->update([
            'nom' => $validated['nom'],
            'id_para' => $validated['id_para'],
            'updated_at' => now()
        ]);

        return redirect()->route('outil-mesure.index')
            ->with('success', 'Outil de mesure mis à jour');
    }

    public function destroy($id)
    {
        DB::table('outilmesure')->where('idot', $id)->delete();
        return redirect()->route('outil-mesure.index')
            ->with('success', 'Outil de mesure supprimé');
    }
}
