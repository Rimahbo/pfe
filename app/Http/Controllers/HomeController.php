<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        // Statistiques principales
        $feuillesCount = DB::table('feuilledemarche')->count();
        $employesCount = DB::table('employe')->count();
        $equipesCount = DB::table('equipe')->count();
        $travauxCount = DB::table('travauxurgence')->where('etat', 'en_cours')->count();

        // Dernières feuilles de marche
        $recentFeuilles = DB::table('feuilledemarche')
            ->join('typefm', 'feuilledemarche.code_type', '=', 'typefm.code_type')
            ->select('feuilledemarche.*', 'typefm.titre as type_titre')
            ->orderBy('date_fm', 'desc')
            ->limit(5)
            ->get();

        // Derniers rapports
        $recentRapports = DB::table('rapport')
            ->join('users', 'rapport.user_id', '=', 'users.id')
            ->select('rapport.*', 'users.name as user_name')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Données pour les graphiques
        $equipeLabels = [];
        $equipeData = [];

        $equipes = DB::table('equipe')
            ->select('bloc_heure', DB::raw('COUNT(*) as count'))
            ->groupBy('bloc_heure')
            ->get();

        foreach ($equipes as $equipe) {
            $equipeLabels[] = $equipe->bloc_heure;
            $equipeData[] = $equipe->count;
        }

        $travauxStats = [
            DB::table('travauxurgence')->where('etat', 'termine')->count(),
            DB::table('travauxurgence')->where('etat', 'en_cours')->count(),
            DB::table('travauxurgence')->where('etat', 'en_attente')->count()
        ];

        return view('home.dashboard', compact(
            'feuillesCount',
            'employesCount',
            'equipesCount',
            'travauxCount',
            'recentFeuilles',
            'recentRapports',
            'equipeLabels',
            'equipeData',
            'travauxStats'
        ));
    }

    public function home()
    {
        return view('home.home');
    }
}
