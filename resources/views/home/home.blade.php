@extends('welcome')
@section('title', 'Accueil - Groupe Chimique Tunisien')

@section('content')

<style>
    /* Style pour le body avec l'image de fond */
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                    url('{{ asset('https://cdnfr.africanmanager.com/wp-content/uploads/2020/08/gct1.jpg') }}') no-repeat center center;
        background-size: cover;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        text-align:center;
        position:relative;
    }

    /* Conteneur principal */
    .main-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Contenu qui change */
    .content-container {
        flex: 1;
        padding: 2rem;
        color: white;
    }

    /* Styles spécifiques pour la page d'accueil */
    .home-content {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 3rem;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.8);
        max-width: 900px;
        margin: 0 auto;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .home-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: linear-gradient(to right, #4facfe, #00f2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .home-text {
        font-size: 1.3rem;
        line-height: 1.8;
        margin-bottom: 3rem;
    }

    .btn-auth {
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        margin: 0 10px;
        border: 2px solid transparent;
    }

    .btn-signin {
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        color: white;
    }

    .btn-signin:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 242, 254, 0.3);
    }

    .btn-signup {
        background: transparent;
        border-color: #4facfe;
        color: #4facfe;
    }

    .btn-signup:hover {
        background: rgba(79, 172, 254, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(79, 172, 254, 0.2);
    }

    @media (max-width: 768px) {
        .home-title {
            font-size: 2.5rem;
        }

        .home-text {
            font-size: 1.1rem;
        }

        .btn-auth {
            padding: 10px 20px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
    }
</style>

<div class="main-container">
    <div class="content-container">
        <div class="home-content">
            <h1 class="home-title">Bienvenue dans Groupe Chimique Tunisien</h1>
            <p class="home-text">
                Fondé en 1971, le GCT est le pilier de l'industrie chimique tunisienne, spécialisé dans la valorisation du phosphate.
                Avec nos sites industriels stratégiques à Gabès, Mdhilla, Skhira et Sfax, nous produisons de l'acide phosphorique,
                des engrais chimiques et divers produits dérivés, contribuant significativement à l'économie nationale.
                <br><br>
                Engagés dans l'innovation technologique et le développement durable, nous façonnons l'avenir de la chimie responsable
                au service de l'agriculture et du progrès industriel.
            </p>

            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn btn-auth btn-signin">
                    <i class="bi bi-box-arrow-in-right"></i> Connexion
                </a>
                <a href="{{ route('register') }}" class="btn btn-auth btn-signup">
                    <i class="bi bi-person-plus"></i> Inscription
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
