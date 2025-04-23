<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Etudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('etudiants.index') }}">Gestion Des Étudiants</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- LEFT SIDE NAVIGATION -->
                 @auth


                                    <ul class="navbar-nav me-auto">
                                        <!-- Etudiants Dropdown -->
                                        <li class="nav-item dropdown">
                                            @if (auth()->user()->user_role === 'admin' || auth()->user()->user_role === 'professeur')
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Liste Des Étudiants
                                            </a>
                                            <ul class="dropdown-menu">

                                                <li><a class="dropdown-item" href="{{ route('etudiants.index') }}">Liste des Étudiants</a>
                                                </li>
                                                @endif
                                                @if (auth()->user()->user_role === 'admin')


                                                <li><a class="dropdown-item" href="{{ route('register.form', 'etudiant') }}">Ajouter
                                                        Étudiant</a></li>
                                                <li><a class="dropdown-item" href="{{ route('etudiants.archives') }}">Étudiants Archivés</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('etudiants.inscrits') }}">Étudiants Inscrits</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('etudiants.audit') }}">Journal d'audit</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                             @if (auth()->user()->user_role === 'admin')
                                        <!-- Cours Dropdown -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Liste des Cours
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('cours.index') }}">Liste des Cours</a></li>
                                                <li><a class="dropdown-item" href="{{ route('cours.create') }}">Ajouter un Cours</a></li>
                                            </ul>
                                        </li>

                                        <!-- Professeurs Dropdown -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Professeurs
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('professeurs.index') }}">Les professeurs</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('register.form', 'professeur') }}">Ajouter un
                                                        Professeur</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Les Utilisateurs
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Les Utilisateurs</a>
                                                </li>

                                            </ul>
                                        </li>
                    @endif
                                    </ul>
                @endauth
                @guest
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.form') }}">Login</a>
                        </li>

                    </ul>
                        @endguest
                        <!-- RIGHT SIDE PROFILE DROPDOWN -->
                        @auth
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->Nom }} {{ Auth::user()->Prénom }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profil</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item m-0 p-0">
                                        @csrf
                                        <button type="submit" class="btn w-100 text-start">Se déconnecter</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>






    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>