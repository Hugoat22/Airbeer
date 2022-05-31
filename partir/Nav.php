<?php

    print_r($_SERVER [ 'PHP_SELF' ])
?>

<main>
    <div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-secondary">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4" id="titre-nsi">Airbeer</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="index.php" class="nav-link " aria-current="page">Accueil</a></li>
                <li class="nav-item"><a href="FAQ.php" class="nav-link ">FAQ</a></li>
                <li class="nav-item"><a href="/page/Connexion.php" class="nav-link">Compte</a></li>
            </ul>
        </header>
    </div>
    <div class="b-example-divider"></div>
</main>