<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniteMesureController extends Controller
{
    public function index()
    {
        $unites = DB::table('unite_mesure')->get();
        return view('unite-mesure.index', compact('unites'));
    }

    public function create()
    {
        return view('unite-mesure.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idun' => 'required|string|max:50|unique:unite_mesure,idun',
            'symbole' => 'required|string|max:10'
        ]);

        DB::table('unite_mesure')->insert([
            'idun' => $validated['idun'],
            'symbole' => $validated['symbole'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('unite-mesure.index')
            ->with('success', 'Unité de mesure créée');
    }

    public function show($id)
    {
        $unite = DB::table('unite_mesure')->where('idun', $id)->first();
        return view('unite-mesure.show', compact('unite'));
    }

    public function edit($id)
    {
        $unite = DB::table('unite_mesure')->where('idun', $id)->first();
        return view('unite-mesure.edit', compact('unite'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'symbole' => 'required|string|max:10'
        ]);

        DB::table('unite_mesure')->where('idun', $id)->update([
            'symbole' => $validated['symbole'],
            'updated_at' => now()
        ]);

        return redirect()->route('unite-mesure.index')
            ->with('success', 'Unité de mesure mise à jour');
    }

    public function destroy($id)
    {
        DB::table('unite_mesure')->where('idun', $id)->delete();
        return redirect()->route('unite-mesure.index')
            ->with('success', 'Unité de mesure supprimée');
    }
}
