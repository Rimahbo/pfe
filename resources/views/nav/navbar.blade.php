<nav class="navbar" style="background-color: rgba(114, 183, 233, 0.8); backdrop-filter: blur(10px); border-radius: 15px;">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold ps-2" href="#">
        Groupe Chimique
      </a>

      <div class="btn-group pe-2 position-relative">
        @guest
            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-1"></i> Mon compte
            </button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('login')}}">
                <i class="bi bi-box-arrow-in-right me-2"></i>Connexion
            </a></li>
            <li><a class="dropdown-item" href="{{route('register')}}">
                <i class="bi bi-person-plus me-2"></i>Inscription
            </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">
                <i class="bi bi-gear me-2"></i>Paramètres
            </a></li>
            </ul>
        @endguest
       @auth
            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name}}
            </button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('app_logout')}}">
            <i class="bi bi-box-arrow-in-right me-2"></i>Déconnexion</a></li>
       @endauth
      </div>
    </div>
  </nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
      var dropdowns = document.querySelectorAll('.dropdown-toggle');

      dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener("click", function (event) {
          event.preventDefault();
          event.stopPropagation();
          let menu = this.nextElementSibling;
          menu.classList.toggle("show");
        });
      });

      document.addEventListener("click", function (e) {
        document.querySelectorAll(".dropdown-menu.show").forEach(function (menu) {
          if (!menu.parentElement.contains(e.target)) {
            menu.classList.remove("show");
          }
        });
      });
    });
</script>
