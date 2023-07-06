<?php

class MyBD extends PDO
{
    function __construct($dsn, $username = null, $password = null, $options = null)
    {
        parent::__construct($dsn, $username, $password, $options);
    }

    # fonction qui l'inscrit dans la base de donnee
    function formInscription($pseudo,$email,$mdp,$telephone) {
        $pdp = "https://tse4.mm.bing.net/th?id=OIP.L7bD0C5u9QBpSvxSSkQ1RAHaHa&pid=Api&P=0&w=179&h=179";
        $inserte = $this->prepare('INSERT INTO Users(PSEUDO,EMAIL,MDP,PDP,TELEPHONE) VALUES(?, ?, ?, ?, ?)');
        $inserte->execute(array($pseudo,$email,$mdp,$pdp,$telephone));

        $message = [false,"<h1>L'inscription a bien été effectué !</h1>"];
        return $message;
    }

    # fonction qui verifies si le pseudo et deja existence ou non dans la base de donnee
    function verif($pseudo) {
        $select = $this->prepare("SELECT PSEUDO FROM Users WHERE PSEUDO = ? ");
        $select->execute([$pseudo]);
        $info = $select->fetchAll();
        return empty($info);
    }

    # fonction qui verifies si le compte existe et si le mot de passe et bon et decide de le connecter ou non
    function formConnexion($utilisateur,$mdp) {
        $insert = $this->prepare('SELECT ID, PSEUDO, MDP, PDP FROM Users WHERE PSEUDO = ? OR EMAIL = ?');
        $insert->execute([$utilisateur,$utilisateur]);

        $info = $insert->fetchAll();

        if(password_verify($mdp,$info[0]['MDP'])) {
            $message = [false,"Connexion validée"];

        } else {
            $message = [true,"Utilisateur ou Mot de Passe incorrect"];
        }
        $result = [$info,$message];
        return $result;
    }

    # fonction qui envoye ces infos personnelles
    function recupe_info($pseudo) {
        $select = $this->prepare('SELECT * FROM Users WHERE PSEUDO = ?');
        $select->execute([$pseudo]);

        $info = $select->fetchAll();
        return $info;
    }

    # fonction qui verif si les modifications sont possibles
    function verifmodif($pseudo,$id) {
        $select = $this->prepare('SELECT PSEUDO FROM Users WHERE PSEUDO = ? EXCEPT SELECT PSEUDO FROM Users WHERE PSEUDO = ? AND ID = ?');
        $select->execute(array($pseudo,$pseudo,$id));

        $info = $select->fetchAll();
        return empty($info);
    }

    #fonction qui met a jour les infos personnelles
    function maj($id,$nom,$prenom,$pseudo,$email,$mdp,$photoprof) {
        $update = $this->prepare('UPDATE Users SET NOM = ?,PRENOM = ?,PSEUDO = ?,EMAIL = ?,MDP = ?,PDP = ? WHERE ID = ?');
        $update->execute(array($nom,$prenom,$pseudo,$email,$mdp,$photoprof,$id));

        $message = [false,"Modification effectuée avec succès"];
        return $message;
    }

    #fonction qui renvoie une valeur boolean si le mail et connue ainsi que sont id
    function verifmail($mail) {
        $select = $this->prepare("SELECT ID FROM Users WHERE EMAIL = ?");
        $select->execute([$mail]);

        $info = $select->fetchAll();
        if (!empty($info)) {
            return [true,$info];
        }
        return [false,$info];
    }

    #fonction qui enregistre les liens temporaires des reset mot de passe
    function EnregLienMdp($id,$lien) {
        $insert = $this->prepare('INSERT INTO setmdp(ID_Users,lIEN) VALUES(?, ?)');
        $insert->execute(array($id,$lien));
    }

    #fonction qui regarde si le lien existe et renvoye sont id si bon
    function CheckLien($lien) {
        $select = $this->prepare('SELECT ID FROM setmdp WHERE LIEN = ?');
        $select->execute([$lien]);

        $info = $select->fetchAll();
        if (!empty($info)) {
            return [true,$info];
        }
        return [false,$info];
    }

    #fonction qui renvoie un message de confirmaton de modification de mot de passe et supprime url plus valide
    function modifMdpOublier($mdp,$lien,$id) {
        $update = $this->prepare('UPDATE Users SET MDP = ? WHERE ID = ?');
        $update->execute([$mdp,$id]);

        $message = [false,"Modification effectuée avec succès"];

        $delete = $this->prepare('DELETE FROM setmdp WHERE LIEN = ?');
        $delete->execute([$lien]);

        return $message;
    }

    #fonction qui affiche les infos users
    function afficheusers() {
        $select = $this->prepare("SELECT * FROM Users");
        $select->execute();

        $info = $select->fetchAll();
        return $info;
    }

    #fonction qui modifie les infos users
    function modifcompte($pseudo,$nom,$prenom,$email,$pdp,$type,$id) {
        $update = $this->prepare('UPDATE Users SET PSEUDO = ?, NOM = ?, PRENOM = ?, EMAIL = ?,PDP = ?,TYPE = ? WHERE ID = ?');
        $update->execute(array($pseudo,$nom,$prenom,$email,$pdp,$type,$id));
    }

    #fonction qui supprime les infos users
    function suppcompte($id) {
        $delete = $this->prepare('DELETE FROM Users WHERE ID = ?');
        $delete->execute([$id]);
    }

}

