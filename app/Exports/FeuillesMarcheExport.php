<?php

namespace App\Exports;

use App\Models\FeuilleDeMarche;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FeuillesMarcheExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return FeuilleDeMarche::with(['type', 'unite'])
            ->get()
            ->map(function ($feuille) {
                return [
                    'ID' => $feuille->id_fm,
                    'Date' => $feuille->date_fm,
                    'Type' => $feuille->type->titre,
                    'Unité' => $feuille->unite->nom,
                    'Statut' => 'Active'
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Type',
            'Unité',
            'Statut'
        ];
    }
}
