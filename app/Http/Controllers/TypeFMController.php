<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeFMController extends Controller
{
    public function index()
    {
        $types = DB::table('typefm')->get();
        return view('type-fm.index', compact('types'));
    }

    public function create()
    {
        return view('type-fm.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_type' => 'required|string|max:50|unique:typefm,code_type',
            'version' => 'required|string|max:50',
            'datetf' => 'required|date',
            'titre' => 'required|string|max:255'
        ]);

        DB::table('typefm')->insert([
            'code_type' => $validated['code_type'],
            'version' => $validated['version'],
            'datetf' => $validated['datetf'],
            'titre' => $validated['titre'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('type-fm.index')
            ->with('success', 'Type de feuille de marche créé');
    }

    public function show($id)
    {
        $type = DB::table('typefm')->where('code_type', $id)->first();
        return view('type-fm.show', compact('type'));
    }

    public function edit($id)
    {
        $type = DB::table('typefm')->where('code_type', $id)->first();
        return view('type-fm.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'version' => 'required|string|max:50',
            'datetf' => 'required|date',
            'titre' => 'required|string|max:255'
        ]);

        DB::table('typefm')->where('code_type', $id)->update([
            'version' => $validated['version'],
            'datetf' => $validated['datetf'],
            'titre' => $validated['titre'],
            'updated_at' => now()
        ]);

        return redirect()->route('type-fm.index')
            ->with('success', 'Type de feuille de marche mis à jour');
    }

    public function destroy($id)
    {
        DB::table('typefm')->where('code_type', $id)->delete();
        return redirect()->route('type-fm.index')
            ->with('success', 'Type de feuille de marche supprimé');
    }
}
