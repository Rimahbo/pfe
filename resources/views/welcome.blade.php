<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Groupe Chimique</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">

    <!-- Style pour le sidebar -->
    <style>
        #wrapper {
            display: flex;
            width: 100%;
        }
        #page-content-wrapper {
            width: 100%;
            min-height: 100vh;
        }

        .sidebar-heading {
            padding: 1.25rem;
            background: #0d6efd;
            color: white;
        }

        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -250px;
            }

            #sidebar-wrapper.active {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Navbar -->

            <!-- Main Content -->
            <div class="container-fluid px-4 py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script pour le toggle du sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ajout du bouton toggle dans le navbar
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'btn btn-primary me-2';
            toggleBtn.innerHTML = '<i class="bi bi-list"></i>';
            toggleBtn.onclick = function() {
                document.getElementById('sidebar-wrapper').classList.toggle('active');
            };

            const navbar = document.querySelector('.navbar');
            if(navbar) {
                navbar.insertBefore(toggleBtn, navbar.firstChild);
            }

            // Highlight du menu actif
            const currentUrl = window.location.href;
            document.querySelectorAll('#sidebar-wrapper a').forEach(link => {
                if(link.href === currentUrl) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
