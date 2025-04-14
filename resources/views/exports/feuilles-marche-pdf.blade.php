<!DOCTYPE html>
<html>
<head>
    <title>Feuilles de Marche</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Feuilles de Marche</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Type</th>
                <th>Unité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feuilles as $feuille)
            <tr>
                <td>FM{{ $feuille->id_fm }}</td>
                <td>{{ $feuille->date_fm->format('d/m/Y') }}</td>
                <td>{{ $feuille->type->titre }}</td>
                <td>{{ $feuille->unite->nom }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
