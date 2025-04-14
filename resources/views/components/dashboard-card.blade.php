@props([
    'title',
    'value',
    'route',
    'color' => 'primary',
    'icon' => 'circle',
    'exportExcel' => null,
    'exportPdf' => null
])

<div class="col-md-3 mb-4">
    <div class="card border-{{ $color }} shadow-sm h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="card-title text-muted text-uppercase small">{{ $title }}</h6>
                    <h2 class="mb-0">{{ $value }}</h2>
                </div>
                <div class="icon-wrapper bg-{{ $color }} bg-opacity-10 p-3 rounded">
                    <i class="bi bi-{{ $icon }} text-{{ $color }} fs-4"></i>
                </div>
            </div>

            <div class="d-flex mt-3">
                <a href="{{ $route }}" class="btn btn-sm btn-outline-{{ $color }} me-2 flex-grow-1">
                    <i class="bi bi-eye"></i> Voir
                </a>

                @if($exportExcel)
                <a href="{{ $exportExcel }}" class="btn btn-sm btn-outline-success" title="Exporter en Excel">
                    <i class="bi bi-file-earmark-excel"></i>
                </a>
                @endif

                @if($exportPdf)
                <a href="{{ $exportPdf }}" class="btn btn-sm btn-outline-danger ms-1" title="Exporter en PDF">
                    <i class="bi bi-file-earmark-pdf"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.icon-wrapper {
    transition: transform 0.3s ease;
}
.card:hover .icon-wrapper {
    transform: scale(1.1);
}
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>
