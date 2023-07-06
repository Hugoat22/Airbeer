<?php
    session_start();

    $titre = "Inscription";

    spl_autoload_register(function ($class_name) { include $class_name . '.php';});

    if (!empty($_POST)) {
        if (isset($_POST['Pseudo']) and isset($_POST['Email']) and isset($_POST['Mdp']) and isset($_POST['MdpConf']) and isset($_POST['Telephone']) and
            !empty($_POST['Pseudo']) and !empty($_POST['Email']) and !empty($_POST['Mdp']) and !empty($_POST['MdpConf']) and !empty($_POST['Telephone'])) {
            if(strlen($_POST['Mdp']) >= 10) {
                if($_POST['Mdp'] != "          ") {
                    if ($_POST['Mdp'] == $_POST['MdpConf']) {

                        $bdd = new MyBD("sqlite:" . __DIR__ . DIRECTORY_SEPARATOR . "AirBeer.db");

                        $pseudo = htmlspecialchars($_POST['Pseudo']);
                        if ($bdd->verif($pseudo)) {
                            $email = htmlspecialchars($_POST['Email']);
                            $mdp = htmlspecialchars($_POST['Mdp']);
                            $mdp = password_hash($mdp,PASSWORD_DEFAULT);
                            $mdpconf = htmlspecialchars($_POST['MdpConf']);
                            $Telephone = htmlspecialchars($_POST['Telephone']);

                            $message = $bdd->formInscription($pseudo, $email, $mdp, $Telephone);

                            header("Refresh:1;url=Connexion.php");
                        }
                        else {
                            $message = [true, "Le pseudo est déjà pris !"];
                        }

                    } else {
                        $message = [true, "Le mot de passe est différent du mot de passe de confirmation !"];
                    }

                } else {
                    $message = [true, "Veuillez ne pas composer votre mot de passe que d'espace pour des raison de securité !"];
                }

            } else {
                $message = [true, "veuillez composer un mot de passe avec au moins 10 caractére !"];
            }

        } else {
            $message = [true, "Veuillez remplir tous les champs obligatoires !"];
        }

    }


?>

<html lang="fr">
    <?php include("Head.php"); ?>
    <body class="text-center">
        <div class="container">
            <?php include("Nav.php");
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
            <form method="post" action="">
                <img class="mb-4" src="img/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Inscription</h1>
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPseudo" name="Pseudo">
                    <label for="floatingPseudo">Pseudo</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" name="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="tel" class="form-control" id="floatingTelephone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" name="Telephone">
                    <label for="floatingTelephone">Telephone</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="Mdp">
                    <label for="floatingPassword">Mot de Passe</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPasswordconf" name="MdpConf">
                    <label for="floatingPasswordconf">Confirmation du Mot de Passe</label>
                </div>
                </br>
                <button class="w-100 btn btn-lg btn-primary" type="submit">S'inscrire</button>
                <p></br>Vous avez deja un compte ? <a href="Connexion.php">S'identifier</a></p>
                <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
            </form>
        </main>
    </body>
</html>