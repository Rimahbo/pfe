<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployesExport implements FromCollection
{
    public function collection()
    {
        return Employe::all();
    }
}
