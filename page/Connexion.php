<?php
    require_once "../config.php";
    $titre = "Se Connecter";

    spl_autoload_register(function ($class_name) { include $class_name . '.php';});

    if (!empty($_POST)) {
        if (isset($_POST['Utilisateur']) AND isset($_POST['Mdp']) AND !empty($_POST['Utilisateur']) AND !empty($_POST['Mdp'])) {
            $bdd = new MyBD("sqlite:" . __DIR__ . DIRECTORY_SEPARATOR . "baseUsers.db");

            $utilisateur =  htmlspecialchars($_POST['Utilisateur']);
            $mdp = htmlspecialchars($_POST['Mdp']);

            $result = $bdd->formConnexion($utilisateur,$mdp);


            if (!$result[1][0]) {
                $_SESSION['ID'] = $result[0][0]['ID'];
                $_SESSION['connection'] = $result[0][0]['PSEUDO'];
                $_SESSION['PDP'] = $result[0][0]['PDP'];
                if ($result[0][0]['TYPE'] == 1) {
                    $_SESSION['admin'] = true;
                }   else {
                    $_SESSION['admin'] = false;
                }
            }
            $message = $result[1];

        } else {
            $message = [true,"Veuillez remplir tous les champs !"];
        }
    }

    if (!empty($_SESSION['connection'])) {
        header("Refresh:1;url=index.php");
    }

?>

<html lang="fr" class="translated-1tr">
    <?php require Airbeer."/partir/Head.php"; ?>
    <body class="text-center">
        <div class="container">
            <?php require Airbeer."/partir/Nav.php";
            if (isset($message) AND !empty($message)) :
                if($message[0] == 'false') :?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo "<p>$message[1]</p>" ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo "<p>$message[1]</p>" ?>
                    </div>
                <?php endif;
            endif; ?>
        </div>

        <main class="form-signin">
            <form action="" method="post">
                <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Connexion</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingInput" name="Utilisateur">
                    <label for="floatingInput">Peusdo - Email</label>
                </div>
                <br>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="Mdp">
                    <label for="floatingPassword">Mot de Passe</label>
                </div>
                <br>
                <div class="checkbox mb-3">
                    <!-- <input type="checkbox" value="remember-me" id="floatingSouvenir" name="souvenir">
                    <label for="floatingSouvenir">Se souvenir de moi</label> -->
                    <p><a href="mailreset.php">Mot de passe oublié !</a></p>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">S'identifier</button>
                <p></br>Vous n'avez pas de compte ? <a href="s'incrire.php">S'incrire</a></p>
            </form>
        </main>
        <?php include("footer.php"); ?>
    </body>
</html>