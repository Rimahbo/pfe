<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    public function index()
    {
        $rapports = DB::table('rapport')
            ->join('feuilledemarche', 'rapport.feuille_marche_id', '=', 'feuilledemarche.id_fm')
            ->select('rapport.*', 'feuilledemarche.date_fm')
            ->get();

        return view('rapport.index', compact('rapports'));
    }

    public function create()
    {
        $feuilles = DB::table('feuilledemarche')->get();
        return view('rapport.create', compact('feuilles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'feuille_marche_id' => 'required|exists:feuilledemarche,id_fm',
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'fichier' => 'nullable|file|max:10240' // 10MB max
        ]);

        $data = [
            'feuille_marche_id' => $validated['feuille_marche_id'],
            'titre' => $validated['titre'],
            'contenu' => $validated['contenu'],
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('rapports');
            $data['fichier'] = $path;
        }

        DB::table('rapport')->insert($data);

        return redirect()->route('rapport.index')
            ->with('success', 'Rapport créé avec succès');
    }

    public function show($id)
    {
        $rapport = DB::table('rapport')
            ->join('feuilledemarche', 'rapport.feuille_marche_id', '=', 'feuilledemarche.id_fm')
            ->join('users', 'rapport.user_id', '=', 'users.id')
            ->where('rapport.id', $id)
            ->select('rapport.*', 'feuilledemarche.date_fm', 'users.name as user_name')
            ->first();

        return view('rapport.show', compact('rapport'));
    }

    public function edit($id)
    {
        $rapport = DB::table('rapport')->where('id', $id)->first();
        $feuilles = DB::table('feuilledemarche')->get();
        return view('rapport.edit', compact('rapport', 'feuilles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'feuille_marche_id' => 'required|exists:feuilledemarche,id_fm',
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'fichier' => 'nullable|file|max:10240'
        ]);

        $data = [
            'feuille_marche_id' => $validated['feuille_marche_id'],
            'titre' => $validated['titre'],
            'contenu' => $validated['contenu'],
            'updated_at' => now()
        ];

        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('rapports');
            $data['fichier'] = $path;
        }

        DB::table('rapport')->where('id', $id)->update($data);

        return redirect()->route('rapport.index')
            ->with('success', 'Rapport mis à jour');
    }

    public function destroy($id)
    {
        DB::table('rapport')->where('id', $id)->delete();
        return redirect()->route('rapport.index')
            ->with('success', 'Rapport supprimé');
    }
    public function journalier()
    {
        return view('rapports.journalier');
        // Logique spécifique au rapport journalier
    }

    public function mensuel()
    {
        return view('rapports.mensuel');
        // Logique spécifique au rapport mensuel
    }

    public function annuel()
    {
        return view('rapports.annuel');
        // Logique spécifique au rapport annuel
    }
}
