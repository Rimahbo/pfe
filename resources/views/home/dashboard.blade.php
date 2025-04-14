
@extends('welcome')
@section('title', 'Tableau de bord - GCT')
@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Professionnel -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #1a2a36;">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('https://d7ieeqxtzpkza.cloudfront.net/wp-content/uploads/2018/02/ag43-gct-groupe-chimique-tunisien.jpg') }}" alt="GCT Logo" style="height: 40px;" class="mb-2">
                    <h4 class="text-white mb-0">Groupe Chimique Tunisien</h4>
                </div>
                <ul class="nav flex-column">
                    <!-- Tableau de bord -->
                    <li class="nav-item">
                        <a class="nav-link active text-white d-flex align-items-center py-3" href="{{ route('app_dashboard') }}" style="background-color: #2a3b4a; border-left: 4px solid #3d7ea6;">
                            <i class="bi bi-speedometer2 me-3 fs-5"></i>
                            <span class="fs-6">Tableau de bord</span>
                        </a>
                    </li>

                    <!-- Gestion des feuilles de marche - Menu déroulant -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center py-3" data-bs-toggle="collapse" href="#feuilleMarcheCollapse" role="button">
                            <i class="bi bi-clipboard2-data me-3 fs-5"></i>
                            <span class="fs-6">Gestion Feuilles de marche</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="collapse" id="feuilleMarcheCollapse">
                            <ul class="nav flex-column ps-4">
                                <li class="nav-item">
                                    <a class="nav-link text-white py-2" href="{{ route('feuille-marche.index') }}">
                                        <i class="bi bi-list-ul me-2"></i> Liste des feuilles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white py-2" href="{{ route('parametre.index') }}">
                                        <i class="bi bi-gear me-2"></i> Paramètres
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white py-2" href="{{ route('outil-mesure.index') }}">
                                        <i class="bi bi-rulers me-2"></i> Outils de mesure
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white py-2" href="{{ route('unite-mesure.index') }}">
                                        <i class="bi bi-box-seam me-2"></i> Unités de mesure
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Gestion des équipes - Menu déroulant -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center py-3" data-bs-toggle="collapse" href="#equipesCollapse" role="button">
                            <i class="bi bi-people-fill me-3 fs-5"></i>
                            <span class="fs-6">Gestion des équipes</span>
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div class="collapse" id="equipesCollapse">
                            <ul class="nav flex-column ps-4">
                                <li class="nav-item">
                                    <a class="nav-link text-white py-2" href="{{ route('employe.index') }}">
                                        <i class="bi bi-person-lines-fill me-2"></i> Liste des employés
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white py-2" href="{{ route('equipe.index') }}">
                                        <i class="bi bi-diagram-3 me-2"></i> Liste des équipes
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Edition des rapports -->
                    <ul class="nav flex-column">
                        <!-- ... autres éléments du menu ... -->
                        <!-- Édition des rapports - Menu déroulant -->
                        <li class="nav-item">
                            <a class="nav-link text-white d-flex align-items-center py-3" data-bs-toggle="collapse" href="#rapportsCollapse" role="button">
                                <i class="bi bi-pencil-square me-3 fs-5"></i>
                                <span class="fs-6">Édition des rapports</span>
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <div class="collapse" id="rapportsCollapse">
                                <ul class="nav flex-column ps-4">
                                    <li class="nav-item">
                                        <a class="nav-link text-white py-2" href="{{ route('typerapport.journalier') }}">
                                            <i class="bi bi-calendar-day me-2"></i> Rapport journalier
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white py-2" href="{{ route('typerapport.mensuel') }}">
                                            <i class="bi bi-calendar-month me-2"></i> Rapport mensuel
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white py-2" href="{{ route('typerapport.annuel') }}">
                                            <i class="bi bi-calendar-month me-2"></i> Rapport annuel
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- ... Votre sidebar existante ... -->
                            <div class="mb-10"></div>
<!-- Section Paramètres et Déconnexion -->
<div class="mt-auto pt-3 border-top border-secondary">
    <!-- Paramètres -->
    <div class="nav-item mb-2">
        <a class="nav-link text-white d-flex align-items-center py-2" href="#">
            <i class="bi bi-gear me-3 fs-5"></i>
            <span class="fs-6">Paramètres</span>
        </a>
    </div>

    <!-- Déconnexion -->
   <!-- Déconnexion avec confirmation -->
<div class="nav-item">
    <a class="nav-link text-white d-flex align-items-center py-2" href="#"
       onclick="confirmLogout(event)">
        <i class="bi bi-box-arrow-right me-3 fs-5"></i>
        <span class="fs-6">Déconnexion</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
                        </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-light">
            <!-- Header avec fil d'Ariane et outils -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div>
                    <h1 class="h2 mb-0 text-primary">Tableau de bord opérationnel</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('app_dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vue globale</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex align-items-center">
                    <div class="btn-group me-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-calendar3 me-1"></i> Période : {{ now()->format('M Y') }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Sélection de période</h6></li>
                            <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                            <li><a class="dropdown-item" href="#">Cette semaine</a></li>
                            <li><a class="dropdown-item" href="#">Ce mois</a></li>
                            <li><a class="dropdown-item" href="#">Trimestre en cours</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Période personnalisée</a></li>
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-download me-1"></i> Exporter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Format d'export</h6></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.export.excel') }}"><i class="bi bi-file-excel me-2 text-success"></i>Excel (.xlsx)</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.export.pdf') }}"><i class="bi bi-file-pdf me-2 text-danger"></i>PDF (.pdf)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Imprimer</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Alertes et indicateurs clés -->
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                    <div>
                        <strong>3 chantiers critiques</strong> nécessitent votre attention aujourd'hui.
                        <a href="#" class="alert-link">Voir les détails</a>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Cartes de KPI professionnelles -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-uppercase text-muted mb-2">Feuilles de marche</h6>
                                    <h2 class="mb-0">{{ $feuillesCount ?? 0 }}</h2>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-clipboard2-data fs-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-{{ $feuillesTrend === 'up' ? 'success' : ($feuillesTrend === 'down' ? 'danger' : 'secondary') }}-subtle text-{{ $feuillesTrend === 'up' ? 'success' : ($feuillesTrend === 'down' ? 'danger' : 'secondary') }}">
                                    <i class="bi bi-arrow-{{ $feuillesTrend === 'up' ? 'up' : ($feuillesTrend === 'down' ? 'down' : 'right') }} me-1"></i>
                                    {{ $feuillesChange ?? 0 }}% vs période précédente
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <a href="{{ route('feuille-marche.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                                <span>Voir toutes les feuilles</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-uppercase text-muted mb-2">Employés actifs</h6>
                                    <h2 class="mb-0">{{ $employesCount ?? 0 }}</h2>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-people-fill fs-4 text-success"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-{{ $employesTrend === 'up' ? 'success' : ($employesTrend === 'down' ? 'danger' : 'secondary') }}-subtle text-{{ $employesTrend === 'up' ? 'success' : ($employesTrend === 'down' ? 'danger' : 'secondary') }}">
                                    <i class="bi bi-arrow-{{ $employesTrend === 'up' ? 'up' : ($employesTrend === 'down' ? 'down' : 'right') }} me-1"></i>
                                    {{ $employesChange ?? 0 }}% vs période précédente
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <a href="{{ route('employe.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                                <span>Gérer les ressources</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-uppercase text-muted mb-2">Équipes opérationnelles</h6>
                                    <h2 class="mb-0">{{ $equipesCount ?? 0 }}</h2>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-diagram-3 fs-4 text-warning"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-{{ $equipesTrend === 'up' ? 'success' : ($equipesTrend === 'down' ? 'danger' : 'secondary') }}-subtle text-{{ $equipesTrend === 'up' ? 'success' : ($equipesTrend === 'down' ? 'danger' : 'secondary') }}">
                                    <i class="bi bi-arrow-{{ $equipesTrend === 'up' ? 'up' : ($equipesTrend === 'down' ? 'down' : 'right') }} me-1"></i>
                                    {{ $equipesChange ?? 0 }}% vs période précédente
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <a href="{{ route('equipe.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                                <span>Voir les équipes</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-uppercase text-muted mb-2">Indicateurs qualité</h6>
                                    <h2 class="mb-0">{{ $tauxQualite ?? 98 }}%</h2>
                                </div>
                                <div class="bg-info bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-award fs-4 text-info"></i>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $tauxQualite ?? 98 }}%" aria-valuenow="{{ $tauxQualite ?? 98 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">Objectif: 95%</small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <a href="{{ route('qualite.index') }}" class="text-decoration-none d-flex align-items-center justify-content-between">
                                <span>Détails qualité</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section principale avec graphiques -->
            <div class="row">
                <!-- Activité récente améliorée -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0"><i class="bi bi-activity me-2 text-primary"></i> Activité récente sur les chantiers</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel"></i> Filtres
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Filtrer par</h6></li>
                                    <li><a class="dropdown-item" href="#">7 derniers jours</a></li>
                                    <li><a class="dropdown-item" href="#">30 derniers jours</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Exporter</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-3">N° FM</th>
                                            <th>Chantier</th>
                                            <th>Équipe</th>
                                            <th>Statut</th>
                                            <th class="text-end pe-3">Progression</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentFeuilles ?? [] as $feuille)
                                        <tr>
                                            <td class="ps-3">
                                                <a href="{{ route('feuille-marche.show', $feuille->id_fm) }}" class="fw-bold text-decoration-none">FM{{ str_pad($feuille->id_fm, 5, '0', STR_PAD_LEFT) }}</a>
                                                <div class="text-muted small">{{ $feuille->date_fm ? date('d/m/Y', strtotime($feuille->date_fm)) : 'N/A' }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <i class="bi bi-building text-muted"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-medium">{{ $feuille->chantier_nom ?? 'Non attribué' }}</div>
                                                        <small class="text-muted">{{ $feuille->chantier_lieu ?? 'Localisation inconnue' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <div class="avatar avatar-xs bg-light-primary rounded-circle">
                                                            <span class="small">E{{ $feuille->equipe_id ?? '0' }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div>{{ $feuille->equipe_nom ?? 'Non attribuée' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if(property_exists($feuille, 'statut'))
                                                    @if($feuille->statut === 'terminé')
                                                        <span class="badge bg-success bg-opacity-10 text-success">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Terminé
                                                        </span>
                                                    @elseif($feuille->statut === 'en cours')
                                                        <span class="badge bg-warning bg-opacity-10 text-warning">
                                                            <i class="bi bi-arrow-repeat me-1"></i> En cours
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                            <i class="bi bi-hourglass me-1"></i> En attente
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary">Statut inconnu</span>
                                                @endif
                                            </td>
                                            <td class="pe-3">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <div class="progress me-2" style="height: 6px; width: 100px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                             style="width: {{ $feuille->progression ?? rand(20, 100) }}%"
                                                             aria-valuenow="{{ $feuille->progression ?? rand(20, 100) }}"
                                                             aria-valuemin="0"
                                                             aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="fw-medium">{{ $feuille->progression ?? rand(20, 100) }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center text-muted">
                                                    <i class="bi bi-clipboard2-x fs-1 mb-3"></i>
                                                    <span>Aucune activité récente</span>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <nav aria-label="Table navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Suivant</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Graphique de performance -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                            <h5 class="mb-0"><i class="bi bi-speedometer2 me-2 text-primary"></i> Performance des équipes</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-calendar3"></i> {{ now()->format('M Y') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Période</h6></li>
                                    <li><a class="dropdown-item" href="#">Semaine en cours</a></li>
                                    <li><a class="dropdown-item" href="#">Mois en cours</a></li>
                                    <li><a class="dropdown-item" href="#">Trimestre en cours</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Période personnalisée</a></li>
                                    </ul>
                                    </div>
                                    </div>
                                    <div class="card-body pt-0">
                                    <div class="chart-container" style="height: 300px;">
                                    <canvas id="teamPerformanceChart"></canvas>
                                    </div>
                                    <div class="mt-3">
                                    <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-2">
                                    <span class="badge-dot bg-primary"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                    <small class="text-muted">Productivité moyenne</small>
                                    <div class="d-flex justify-content-between">
                                    <span class="fw-medium">78%</span>
                                    <small class="text-success">+2.5% vs mois dernier</small>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 me-2">
                                    <span class="badge-dot bg-success"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                    <small class="text-muted">Qualité moyenne</small>
                                    <div class="d-flex justify-content-between">
                                    <span class="fw-medium">92%</span>
                                    <small class="text-success">+1.2% vs mois dernier</small>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                    <span class="badge-dot bg-warning"></span>
                                    </div>
                                    <div class="flex-grow-1">
                                    <small class="text-muted">Retards moyens</small>
                                    <div class="d-flex justify-content-between">
                                    <span class="fw-medium">5%</span>
                                    <small class="text-danger">-0.8% vs mois dernier</small>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    Copy
                                                <!-- Calendrier des chantiers -->
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                                                            <h5 class="mb-0"><i class="bi bi-calendar-date me-2 text-primary"></i> Calendrier des chantiers</h5>
                                                            <div class="btn-group">
                                                                <button class="btn btn-sm btn-outline-secondary" type="button" title="Mois précédent">
                                                                    <i class="bi bi-chevron-left"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary" type="button" title="Aujourd'hui">
                                                                    Aujourd'hui
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary" type="button" title="Mois suivant">
                                                                    <i class="bi bi-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div id="chantierCalendar"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Alertes et actions -->
                                                <div class="col-lg-6 mb-4">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                                                            <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i> Alertes nécessitant une action</h5>
                                                            <span class="badge bg-warning rounded-pill">{{ count($alertes ?? []) }}</span>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="list-group list-group-flush">
                                                                @forelse($alertes ?? [] as $alerte)
                                                                <div class="list-group-item list-group-item-action border-0 py-3">
                                                                    <div class="d-flex align-items-start">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            @if($alerte['niveau'] === 'critique')
                                                                            <i class="bi bi-exclamation-octagon-fill fs-4 text-danger"></i>
                                                                            @elseif($alerte['niveau'] === 'important')
                                                                            <i class="bi bi-exclamation-triangle-fill fs-4 text-warning"></i>
                                                                            @else
                                                                            <i class="bi bi-info-circle-fill fs-4 text-info"></i>
                                                                            @endif
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                                                <h6 class="mb-0">{{ $alerte['titre'] }}</h6>
                                                                                <small class="text-muted">{{ $alerte['date'] }}</small>
                                                                            </div>
                                                                            <p class="mb-1">{{ $alerte['message'] }}</p>
                                                                            <div class="d-flex justify-content-end mt-2">
                                                                                <button class="btn btn-sm btn-outline-secondary me-2">Ignorer</button>
                                                                                <button class="btn btn-sm btn-primary">Voir</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @empty
                                                                <div class="text-center py-5">
                                                                    <div class="d-flex flex-column align-items-center text-muted">
                                                                        <i class="bi bi-check-circle-fill fs-1 mb-3 text-success"></i>
                                                                        <span>Aucune alerte nécessitant une action</span>
                                                                    </div>
                                                                </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                    </div>
                                    @section('scripts')

                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script><script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script><script> // Initialisation du graphique de performance document.addEventListener('DOMContentLoaded', function() { const ctx = document.getElementById('teamPerformanceChart').getContext('2d'); const teamPerformanceChart = new Chart(ctx, { type: 'bar', data: { labels: ['Équipe 1', 'Équipe 2', 'Équipe 3', 'Équipe 4', 'Équipe 5'], datasets: [ { label: 'Productivité', data: [85, 72, 90, 65, 80], backgroundColor: 'rgba(13, 110, 253, 0.7)', borderColor: 'rgba(13, 110, 253, 1)', borderWidth: 1 }, { label: 'Qualité', data: [95, 88, 92, 85, 90], backgroundColor: 'rgba(25, 135, 84, 0.7)', borderColor: 'rgba(25, 135, 84, 1)', borderWidth: 1 } ] }, options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, max: 100, ticks: { callback: function(value) { return value + '%'; } } } }, plugins: { legend: { position: 'top', }, tooltip: { callbacks: { label: function(context) { return context.dataset.label + ': ' + context.raw + '%'; } } } } } }); // Initialisation du calendrier const calendarEl = document.getElementById('chantierCalendar'); const calendar = new FullCalendar.Calendar(calendarEl, { initialView: 'dayGridMonth', headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay' }, events: [ { title: 'Chantier A - Début', start: new Date(), color: '#0d6efd' }, { title: 'Chantier B - Réunion', start: new Date(new Date().setDate(new Date().getDate() + 2)), color: '#fd7e14' }, { title: 'Chantier C - Livraison', start: new Date(new Date().setDate(new Date().getDate() + 5)), color: '#198754' } ], locale: 'fr', buttonText: { today: 'Aujourd\'hui', month: 'Mois', week: 'Semaine', day: 'Jour' } }); calendar.render(); }); </script>
                                    @endsection

                                    @endsection

                                    @section('styles')

                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css"> <style> .sidebar { min-height: 100vh; position: relative; }
                                    Copy
                                    .avatar {
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                    }

                                    .avatar span {
                                        font-weight: 600;
                                    }

                                    .badge-dot {
                                        display: inline-block;
                                        width: 10px;
                                        height: 10px;
                                        border-radius: 50%;
                                    }

                                    .chart-container {
                                        position: relative;
                                    }

                                    #chantierCalendar {
                                        min-height: 300px;
                                    }

                                    .fc .fc-toolbar-title {
                                        font-size: 1.1rem;
                                    }

                                    .fc .fc-button {
                                        padding: 0.3rem 0.5rem;
                                        font-size: 0.8rem;
                                    }
                                    </style>
                                    @endsection
