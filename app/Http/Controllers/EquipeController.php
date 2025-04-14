<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipeController extends Controller
{
    public function index()
    {
        $equipes = DB::table('equipe')
            ->leftJoin('feuilledemarche', 'equipe.id_fm', '=', 'feuilledemarche.id_fm')
            ->leftJoin('employe', 'equipe.id_eq', '=', 'employe.id_eq')
            ->select(
                'equipe.id_eq',
                'equipe.bloc_heure',
                'equipe.id_fm',
                'feuilledemarche.date_fm',
                DB::raw('COUNT(employe.id) as employes_count')
            )
            ->groupBy('equipe.id_eq', 'equipe.bloc_heure', 'equipe.id_fm', 'feuilledemarche.date_fm')
            ->get();

        return view('equipe.index', compact('equipes'));
    }

    public function create()
    {
        $feuilles = DB::table('feuilledemarche')->get();
        $employes = DB::table('employe')->get();
        return view('equipe.create', compact('feuilles', 'employes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_fm' => 'required|exists:feuilledemarche,id_fm',
            'bloc_heure' => 'required|string|max:10',
            'employes' => 'required|array',
            'employes.*' => 'exists:employe,id'
        ]);

        $id_eq = DB::table('equipe')->insertGetId([
            'id_fm' => $validated['id_fm'],
            'bloc_heure' => $validated['bloc_heure'],
            'date_eq' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($validated['employes'] as $id_employe) {
            DB::table('employe')->where('id', $id_employe)->update([
                'id_eq' => $id_eq,
                'updated_at' => now()
            ]);
        }

        return redirect()->route('equipe.index')
            ->with('success', 'Équipe créée avec succès');
    }

    public function show($id)
    {
        $equipe = DB::table('equipe')
            ->leftJoin('feuilledemarche', 'equipe.id_fm', '=', 'feuilledemarche.id_fm')
            ->where('equipe.id_eq', $id)
            ->first();

        $employes = DB::table('employe')->where('id_eq', $id)->get();

        return view('equipe.show', compact('equipe', 'employes'));
    }

    public function edit($id)
    {
        $equipe = DB::table('equipe')->where('id_eq', $id)->first();
        $feuilles = DB::table('feuilledemarche')->get();
        $employes = DB::table('employe')->get();
        $currentEmployes = DB::table('employe')->where('id_eq', $id)->pluck('id')->toArray();

        return view('equipe.edit', compact('equipe', 'feuilles', 'employes', 'currentEmployes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_fm' => 'required|exists:feuilledemarche,id_fm',
            'bloc_heure' => 'required|string|max:10',
            'employes' => 'required|array',
            'employes.*' => 'exists:employe,id'
        ]);

        DB::table('equipe')->where('id_eq', $id)->update([
            'id_fm' => $validated['id_fm'],
            'bloc_heure' => $validated['bloc_heure'],
            'updated_at' => now()
        ]);

        // Reset all employes
        DB::table('employe')->where('id_eq', $id)->update(['id_eq' => null]);

        // Set new employes
        foreach ($validated['employes'] as $id_employe) {
            DB::table('employe')->where('id', $id_employe)->update([
                'id_eq' => $id,
                'updated_at' => now()
            ]);
        }

        return redirect()->route('equipe.index')
            ->with('success', 'Équipe mise à jour');
    }

    public function destroy($id)
    {
        DB::table('employe')->where('id_eq', $id)->update(['id_eq' => null]);
        DB::table('equipe')->where('id_eq', $id)->delete();
        return redirect()->route('equipe.index')
            ->with('success', 'Équipe supprimée');
    }
}
