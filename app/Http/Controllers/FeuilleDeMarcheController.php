<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeuilleDeMarcheController extends Controller
{
    public function index()
    {
        $feuilles = DB::table('feuilledemarche')
            ->join('typefm', 'feuilledemarche.code_type', '=', 'typefm.code_type')
            ->leftJoin('unite', 'feuilledemarche.id_fm', '=', 'unite.id_fm')
            ->select(
                'feuilledemarche.id_fm',
                'feuilledemarche.date_fm',
                'feuilledemarche.code_type',
                'typefm.titre as type_titre',
                DB::raw('GROUP_CONCAT(unite.nom SEPARATOR ", ") as unites_noms')
            )
            ->groupBy([
                'feuilledemarche.id_fm',
                'feuilledemarche.date_fm',
                'feuilledemarche.code_type',
                'typefm.titre'
            ])
            ->get()
            ->map(function ($item) {
                $item->date_fm = Carbon::parse($item->date_fm);
                return $item;
            });

        return view('feuille-marche.index', compact('feuilles'));
    }

    public function create()
    {
        $types = DB::table('typefm')->get();
        $unites = DB::table('unite')->get();
        return view('feuille-marche.create', compact('types', 'unites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_type' => 'required|exists:typefm,code_type',
            'date_fm' => 'required|date',
            'unites' => 'required|array',
            'unites.*' => 'exists:unite,id_up'
        ]);

        DB::beginTransaction();

        try {
            $id_fm = DB::table('feuilledemarche')->insertGetId([
                'code_type' => $validated['code_type'],
                'date_fm' => $validated['date_fm'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach ($validated['unites'] as $id_up) {
                DB::table('unite')->where('id_up', $id_up)->update([
                    'id_fm' => $id_fm,
                    'updated_at' => now()
                ]);
            }

            DB::commit();

            return redirect()->route('feuille-marche.index')
                ->with('success', 'Feuille de marche créée avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la création: ' . $e->getMessage());
        }
    }
    // Dans FeuilleDeMarcheController.php

    public function show($id)
    {
        $feuille = DB::table('feuilledemarche')
            ->join('typefm', 'feuilledemarche.code_type', '=', 'typefm.code_type')
            ->select(
                'feuilledemarche.*',
                'typefm.titre as type_titre',
                'typefm.version as type_version'
            )
            ->where('id_fm', $id)
            ->first();

        if (!$feuille) {
            abort(404);
        }

        // Initialisation complète de la structure des paramètres
        $heures = ['8', '12', '16', '20', '0', '4'];
        $sections = ['vapeur', 'huile', 'turbine', 'alternateur'];

        $parametres = array_fill_keys($sections, array_fill_keys($heures, collect()));

        // Récupération et organisation des paramètres
        $dbParametres = DB::table('parametres')
            ->where('id_fm', $id)
            ->get()
            ->groupBy(['section', 'heure']);

        foreach ($dbParametres as $section => $heuresData) {
            foreach ($heuresData as $heure => $params) {
                if (isset($parametres[$section][$heure])) {
                    $parametres[$section][$heure] = $params;
                }
            }
        }

        return view('feuille-marche.show', [
            'feuille' => $feuille,
            'parametres' => $parametres,
            'unites' => DB::table('unite')->where('id_fm', $id)->get(),
            'equipes' => DB::table('equipe')->where('id_fm', $id)->get()
        ]);
    }
    public function edit($id)
    {
        $feuille = DB::table('feuilledemarche')->where('id_fm', $id)->first();

        if (!$feuille) {
            abort(404);
        }

        $types = DB::table('typefm')->get();
        $unites = DB::table('unite')->get();
        $currentUnites = DB::table('unite')->where('id_fm', $id)->pluck('id_up')->toArray();

        return view('feuille-marche.edit', compact('feuille', 'types', 'unites', 'currentUnites'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code_type' => 'required|exists:typefm,code_type',
            'date_fm' => 'required|date',
            'unites' => 'required|array',
            'unites.*' => 'exists:unite,id_up'
        ]);

        DB::beginTransaction();

        try {
            // Update feuille de marche
            DB::table('feuilledemarche')->where('id_fm', $id)->update([
                'code_type' => $validated['code_type'],
                'date_fm' => $validated['date_fm'],
                'updated_at' => now()
            ]);

            // First, remove association from units not in the new selection
            DB::table('unite')
                ->where('id_fm', $id)
                ->whereNotIn('id_up', $validated['unites'])
                ->update(['id_fm' => null]);

            // Then add association to newly selected units
            DB::table('unite')
                ->whereIn('id_up', $validated['unites'])
                ->update([
                    'id_fm' => $id,
                    'updated_at' => now()
                ]);

            DB::commit();

            return redirect()->route('feuille-marche.index')
                ->with('success', 'Feuille de marche mise à jour');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            DB::table('unite')->where('id_fm', $id)->update(['id_fm' => null]);
            DB::table('feuilledemarche')->where('id_fm', $id)->delete();

            DB::commit();

            return redirect()->route('feuille-marche.index')
                ->with('success', 'Feuille de marche supprimée');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}
