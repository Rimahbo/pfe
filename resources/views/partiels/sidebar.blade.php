<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading bg-primary text-white p-3">
        <h4 class="mb-0">Menu</h4>
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('app_dashboard') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('feuille-marche.index') }}" class="list-group-item list-group-item-action active">
            <i class="bi bi-clipboard-data me-2"></i> Feuilles de Marche
        </a>
        <a href="{{ route('equipe.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people me-2"></i> Équipes
        </a>
        <a href="{{ route('employe.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-person-lines-fill me-2"></i> Employés
        </a>
        <a href="{{ route('travaux-urgence.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-exclamation-triangle me-2"></i> Travaux d'Urgence
        </a>
        <a href="{{ route('rapport.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-file-earmark-text me-2"></i> Rapports
        </a>
    </div>
</div>
