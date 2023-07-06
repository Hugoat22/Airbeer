<?php
    session_start();

    spl_autoload_register(function ($class_name) { include $class_name . '.php';});

    $bdd = new MyBD("sqlite:" . __DIR__ . DIRECTORY_SEPARATOR . "AirBeer.db");

    if (isset($_GET["OUT"]) AND $_GET["OUT"]=="true") {
        $_SESSION["connection"]="";
        session_destroy();
        header("location:index.php");
        exit();
    }

    $titre = "Airbeer - Acceille"
?>

<html lang="fr">
    <?php
        include("Head.php");
        include("Nav.php");
    ?>

    <body>

    </body>

    <?php include("Footer.php"); ?>
</html>
