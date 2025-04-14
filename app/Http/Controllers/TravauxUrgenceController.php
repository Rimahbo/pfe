<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TravauxUrgenceController extends Controller
{
    public function index()
    {
        $travaux = DB::table('travauxurgence')
            ->join('unite', 'travauxurgence.id_up', '=', 'unite.id_up')
            ->join('employe', 'travauxurgence.id', '=', 'employe.id')
            ->select('travauxurgence.*', 'unite.nom as unite_nom', 'employe.nom as employe_nom', 'employe.prenom as employe_prenom')
            ->get();

        return view('travaux-urgence.index', compact('travaux'));
    }

    public function create()
    {
        $unites = DB::table('unite')->get();
        $employes = DB::table('employe')->get();
        return view('travaux-urgence.create', compact('unites', 'employes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:100',
            'etat' => 'required|string|in:en_cours,termine',
            'id_up' => 'required|exists:unite,id_up',
            'id' => 'required|exists:employe,id'
        ]);

        DB::table('travauxurgence')->insert([
            'description' => $validated['description'],
            'etat' => $validated['etat'],
            'id_up' => $validated['id_up'],
            'id' => $validated['id'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('travaux-urgence.index')
            ->with('success', 'Travail d\'urgence créé');
    }

    public function show($id)
    {
        $travail = DB::table('travauxurgence')
            ->join('unite', 'travauxurgence.id_up', '=', 'unite.id_up')
            ->join('employe', 'travauxurgence.id', '=', 'employe.id')
            ->where('travauxurgence.id_travaux', $id)
            ->select('travauxurgence.*', 'unite.nom as unite_nom', 'employe.nom as employe_nom', 'employe.prenom as employe_prenom')
            ->first();

        return view('travaux-urgence.show', compact('travail'));
    }

    public function edit($id)
    {
        $travail = DB::table('travauxurgence')->where('id_travaux', $id)->first();
        $unites = DB::table('unite')->get();
        $employes = DB::table('employe')->get();
        return view('travaux-urgence.edit', compact('travail', 'unites', 'employes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:100',
            'etat' => 'required|string|in:en_cours,termine',
            'id_up' => 'required|exists:unite,id_up',
            'id' => 'required|exists:employe,id'
        ]);

        DB::table('travauxurgence')->where('id_travaux', $id)->update([
            'description' => $validated['description'],
            'etat' => $validated['etat'],
            'id_up' => $validated['id_up'],
            'id' => $validated['id'],
            'updated_at' => now()
        ]);

        return redirect()->route('travaux-urgence.index')
            ->with('success', 'Travail d\'urgence mis à jour');
    }

    public function destroy($id)
    {
        DB::table('travauxurgence')->where('id_travaux', $id)->delete();
        return redirect()->route('travaux-urgence.index')
            ->with('success', 'Travail d\'urgence supprimé');
    }
}
