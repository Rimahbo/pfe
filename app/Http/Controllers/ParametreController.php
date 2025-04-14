<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametreController extends Controller
{
    public function index()
{
    $parametres = DB::table('parametres')
        ->leftJoin('outilmesure', 'parametres.id_para', '=', 'outilmesure.id_para')
        ->select(
            'parametres.id_para',
            'parametres.titre',
            'parametres.valmin',
            'parametres.valmax',
            // Ajoutez toutes les colonnes nécessaires
            DB::raw('COUNT(outilmesure.idot) as outils_count')
        )
        ->groupBy(
            'parametres.id_para',
            'parametres.titre',
            'parametres.valmin',
            'parametres.valmax'
            // Ajoutez les mêmes colonnes que dans le SELECT
        )
        ->get();

    return view('parametre.index', compact('parametres'));
}

    public function create()
    {
        $unites = DB::table('unite_mesure')->get();
        return view('parametre.create', compact('unites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'valmin' => 'required|numeric',
            'valmax' => 'required|numeric',
            'unite_mesure_id' => 'required|exists:unite_mesure,idun'
        ]);

        DB::table('parametres')->insert([
            'titre' => $validated['titre'],
            'valmin' => $validated['valmin'],
            'valmax' => $validated['valmax'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('parametre.index')
            ->with('success', 'Paramètre créé avec succès');
    }

    public function show($id)
    {
        $parametre = DB::table('parametres')->where('id_para', $id)->first();
        $outils = DB::table('outilmesure')->where('id_para', $id)->get();
        $valeurs = DB::table('valpara')->where('id_para', $id)->get();

        return view('parametre.show', compact('parametre', 'outils', 'valeurs'));
    }

    public function edit($id)
    {
        $parametre = DB::table('parametres')->where('id_para', $id)->first();
        $unites = DB::table('unite_mesure')->get();
        return view('parametre.edit', compact('parametre', 'unites'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'valmin' => 'required|numeric',
            'valmax' => 'required|numeric',
            'unite_mesure_id' => 'required|exists:unite_mesure,idun'
        ]);

        DB::table('parametres')->where('id_para', $id)->update([
            'titre' => $validated['titre'],
            'valmin' => $validated['valmin'],
            'valmax' => $validated['valmax'],
            'updated_at' => now()
        ]);

        return redirect()->route('parametre.index')
            ->with('success', 'Paramètre mis à jour');
    }

    public function destroy($id)
    {
        DB::table('parametres')->where('id_para', $id)->delete();
        return redirect()->route('parametre.index')
            ->with('success', 'Paramètre supprimé');
    }
}
