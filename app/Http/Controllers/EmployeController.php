<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = DB::table('employe')
            ->leftJoin('equipe', 'employe.id_eq', '=', 'equipe.id_eq')
            ->select('employe.*', 'equipe.bloc_heure as equipe_bloc')
            ->paginate();

        return view('employe.index', compact('employes'));
    }

    public function create()
    {
        $equipes = DB::table('equipe')->get();
        return view('employe.create', compact('equipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:employe,email',
            'fonction' => 'required|string|max:100',
            'id_eq' => 'nullable|exists:equipe,id_eq',
            'mdp' => 'required|min:8'
        ]);
        $newId = DB::table('employe')->max('id') + 1;

        DB::table('employe')->insert([
            'id' => $newId,
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'fonction' => $validated['fonction'],
            'id_eq' => $validated['id_eq'],
            'mdp' => Hash::make($validated['mdp'])

        ]);

        return redirect()->route('employe.index')
            ->with('success', 'Employé créé avec succès');
    }

    public function show($id)
    {
        $employe = DB::table('employe')
            ->leftJoin('equipe', 'employe.id_eq', '=', 'equipe.id_eq')
            ->where('employe.id', $id)
            ->first();

        return view('employe.show', compact('employe'));
    }


    public function edit($id)
{
    $employe = DB::table('employe')->where('id', $id)->first();

    // Solution 1: Si vous avez un identifiant significatif
    $equipes = DB::table('equipe')
               ->select('id_eq')
               ->get()
               ->map(function ($item) {
                   $item->nom_affiche = "Équipe " . $item->id_eq; // Génération dynamique
                   return $item;
               });

    // Solution 2: Si vous avez d'autres champs à combiner
    // $equipes = DB::table('equipe')
    //            ->select('id_eq', 'bloc_heure')
    //            ->get()
    //            ->map(function ($item) {
    //                $item->nom_affiche = "Équipe {$item->id_eq} ({$item->bloc_heure})";
    //                return $item;
    //            });

    return view('employe.edit', compact('employe', 'equipes'));
}

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:employe,email,'.$id,
            'fonction' => 'required|string|max:100',
            'id_eq' => 'nullable|exists:equipe,id_eq',
            'mdp' => 'nullable|min:8'
        ]);

        $data = [
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'fonction' => $validated['fonction'],
            'id_eq' => $validated['id_eq'],
            'updated_at' => now()
        ];

        if (!empty($validated['mdp'])) {
            $data['mdp'] = Hash::make($validated['mdp']);
        }

        DB::table('employe')->where('id', $id)->update($data);

        return redirect()->route('employe.index')
            ->with('success', 'Employé mis à jour');
    }

    public function destroy($id)
    {
        DB::table('employe')->where('id', $id)->delete();
        return redirect()->route('employe.index')
            ->with('success', 'Employé supprimé');
    }
}
