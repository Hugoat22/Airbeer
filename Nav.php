<?php

?>

<main>
    <div class="container-fluid">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-secondary">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4" id="titre-nsi">Airbeer</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="index.php" class="nav-link <?php if  ($titre == "Airbeer - Acceille") { echo "active";} ?>" aria-current="page">Accueil</a></li>
                <li class="nav-item"><a href="FAQ.php" class="nav-link <?php if  ($titre == "Airbeer - FAQ") { echo "active";} ?>">FAQ</a></li>
                <?php if (!isset($_SESSION['connection'])): ?>
                <li class="nav-item"><a href="Connexion.php" class="nav-link <?php if  ($titre == "Airbeer - Se Connecter") { echo "active";} ?>">Compte</a></li>
                <?php else: ?>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none  dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php if (isset($_SESSION['PDP'])) {echo $_SESSION['PDP'];} ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    </ul>
                </div>
                <?php endif; ?>
            </ul>
        </header>
    </div>
    <div class="b-example-divider"></div>
</main>