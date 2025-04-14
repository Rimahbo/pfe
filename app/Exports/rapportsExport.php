<?php

namespace App\Exports;

use App\Models\Rapport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RapportsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Rapport::with(['user', 'feuilleMarche'])
            ->get()
            ->map(function ($rapport) {
                return [
                    'ID' => $rapport->id,
                    'Titre' => $rapport->titre,
                    'Feuille de marche' => $rapport->feuille_marche_id,
                    'Créé par' => $rapport->user->name,
                    'Date création' => $rapport->created_at->format('d/m/Y H:i'),
                    'Contenu' => strip_tags($rapport->contenu)
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Titre',
            'Feuille de marche',
            'Créé par',
            'Date création',
            'Contenu'
        ];
    }
}
