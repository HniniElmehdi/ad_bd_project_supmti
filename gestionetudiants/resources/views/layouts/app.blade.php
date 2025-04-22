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
            <a class="navbar-brand" href="{{ route('etudiants.index') }}">Gestion Des Etudiants</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <!-- Etudiants Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('etudiants.index') }}" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Liste Des Étudiants
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('etudiants.index') }}">Liste des Étudiants</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('etudiants.create') }}">Ajouter Étudiant</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('etudiants.archives') }}">Étudiants Archivés</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('etudiants.createWithInscription') }}">Inscrire
                                    un
                                    Étudiant</a></li>
                            <li><a class="dropdown-item" href="{{ route('etudiants.inscrits') }}">Étudiants Inscrits</a>
                            <li><a class="dropdown-item" href="{{ route('etudiants.audit') }}">le journal d'audit</a>
                            </li>
                        </ul>
                    </li>

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

                    <!-- Professeurs Dropdown (future use) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('professeurs.index') }}" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Professeurs
                        </a>
                        <ul class="dropdown-menu">

                            <li><a class="dropdown-item" href="{{ route('professeurs.index') }}">Les professeurs
                            <li><a class="dropdown-item" href="{{ route('professeurs.create') }}">Ajouter un
                                    Professeur</a></li>

                        </ul>
                    </li>
                    @if (!Auth::user())
                    <li class="nav-item ">
                        <a href="{{ route('login.form') }}">login</a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ route('register.form') }}">register</a>
                    </li>
                    @endif

                    @if (Auth::user())


                    <a href="" class="nav_link">
                        <!-- Add this to your main layout or wherever you want the logout link -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>

                    </a>
                    @endif
                </ul>
                <span class="text-white">
                    @if (Auth::user())
                    {{ Auth::user()->Nom }} {{ Auth::user()->Prénom }}
                    @endif
                </span>
            </div>
        </div>
    </nav>




    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('etudiants.index') }}">Gestion des Etudiants</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.create') }}">Ajouter Etudiant</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.archives') }}">Etudiants Archivé</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.createWithInscription') }}">Ajouter Etudiant à
                            Cour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etudiants.inscrits') }}">etudiants inscrit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>