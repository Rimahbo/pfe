<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniteController extends Controller
{
    public function index()
    {
        $unites = DB::table('unite')
            ->leftJoin('feuilledemarche', 'unite.id_fm', '=', 'feuilledemarche.id_fm')
            ->select('unite.*', 'feuilledemarche.date_fm')
            ->get();

        return view('unite.index', compact('unites'));
    }

    public function create()
    {
        $feuilles = DB::table('feuilledemarche')->get();
        return view('unite.create', compact('feuilles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_up' => 'required|string|max:50|unique:unite,id_up',
            'nom' => 'required|string|max:100',
            'localisation' => 'required|string|max:100',
            'id_fm' => 'nullable|exists:feuilledemarche,id_fm'
        ]);

        DB::table('unite')->insert([
            'id_up' => $validated['id_up'],
            'nom' => $validated['nom'],
            'localisation' => $validated['localisation'],
            'id_fm' => $validated['id_fm'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('unite.index')
            ->with('success', 'Unité créée avec succès');
    }

    public function show($id)
    {
        $unite = DB::table('unite')
            ->leftJoin('feuilledemarche', 'unite.id_fm', '=', 'feuilledemarche.id_fm')
            ->where('unite.id_up', $id)
            ->select('unite.*', 'feuilledemarche.date_fm')
            ->first();

        return view('unite.show', compact('unite'));
    }

    public function edit($id)
    {
        $unite = DB::table('unite')->where('id_up', $id)->first();
        $feuilles = DB::table('feuilledemarche')->get();
        return view('unite.edit', compact('unite', 'feuilles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'localisation' => 'required|string|max:100',
            'id_fm' => 'nullable|exists:feuilledemarche,id_fm'
        ]);

        DB::table('unite')->where('id_up', $id)->update([
            'nom' => $validated['nom'],
            'localisation' => $validated['localisation'],
            'id_fm' => $validated['id_fm'],
            'updated_at' => now()
        ]);

        return redirect()->route('unite.index')
            ->with('success', 'Unité mise à jour');
    }

    public function destroy($id)
    {
        DB::table('unite')->where('id_up', $id)->delete();
        return redirect()->route('unite.index')
            ->with('success', 'Unité supprimée');
    }
}
