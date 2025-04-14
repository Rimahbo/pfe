<?php

namespace App\Http\Controllers;

use App\Exports\FeuillesMarcheExport;
use App\Exports\EmployesExport;
use App\Exports\RapportsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Models\FeuilleDeMarche;
use App\Models\Employe;
use App\Models\Rapport;

class ExportController extends Controller
{
    // Export Feuilles de marche
    public function exportFeuillesMarcheExcel()
    {
        return Excel::download(new FeuillesMarcheExport(), 'feuilles-marche.xlsx');
    }

    public function exportFeuillesMarchePdf()
    {
        $feuilles = FeuilleDeMarche::with(['type', 'unite'])->latest()->get();
        $pdf = PDF::loadView('exports.feuilles-marche-pdf', compact('feuilles'));
        return $pdf->download('feuilles-marche.pdf');
    }

    // Export Employés
    public function exportEmployesExcel()
    {
        return Excel::download(new EmployesExport(), 'employes.xlsx');
    }

    public function exportEmployesPdf()
    {
        $employes = Employe::latest()->get();
        $pdf = PDF::loadView('exports.employes-pdf', compact('employes'));
        return $pdf->download('employes.pdf');
    }

    // Export Rapports
    public function exportRapportsExcel()
    {
        return Excel::download(new RapportsExport(), 'rapports.xlsx');
    }

    public function exportRapportsPdf()
    {
        $rapports = Rapport::with(['user', 'feuilleMarche'])->latest()->get();
        $pdf = PDF::loadView('exports.rapports-pdf', compact('rapports'));
        return $pdf->download('rapports.pdf');
    }
}
