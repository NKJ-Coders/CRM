<?php
session_start();

require_once('include/connexion.php');

$login = $_POST['login'];
$password = $_POST['password'];

// se logger
if (isset($_POST['submit'])) {

    if (!empty($login) && !empty($password)) {
        $req = $bdd->prepare('SELECT * FROM user WHERE login=?  AND password =?');
        $req->execute(array(
            $login,
            $password
        ));
        $resultat = $req->fetch();
        // var_dump($resultat['idcompte']);
        // exit;
        if (empty($resultat)) {
            require '404.php';
        } else {
            // rechercher le nom du USER
            if ($resultat['type'] == 'Commercial') {
                $req = $bdd->prepare('SELECT * FROM commercial WHERE IDCOM=?');
                $req->execute(array(
                    $resultat['idcompte']
                ));
                $result = $req->fetch();

                $nom = $result['NOMCOM'];
            } elseif ($resultat['type'] == 'admin') {
                $req = $bdd->prepare('SELECT * FROM admin WHERE id=?');
                $req->execute(array(
                    $resultat['idcompte']
                ));
                $result = $req->fetch();

                $nom = $result['nom'];
            } elseif ($resultat['type'] == 'Partenaire') {
                $req = $bdd->prepare('SELECT * FROM partenaire WHERE id=?');
                $req->execute(array(
                    $resultat['idcompte']
                ));
                $result = $req->fetch();

                $nom = $result['nom'];
            }

            // se souvenir de moi
            if (isset($_POST['remember']) && $_POST['remember'] == 'remember-me') {
                setcookie('login', $login, time() + 24 * 7 * 3600);
                setcookie('password', $password, time() + 24 * 7 * 3600);
            }

            $_SESSION['id'] = $resultat['idcompte'];
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $_SESSION['type'] = $resultat['type'];
            $_SESSION['photo'] = $resultat['photo'];
            $_SESSION['nom'] = $nom;
            if ($resultat['type'] == 'admin') {
                header('Location:accueil.php');
            } else {
                header('Location:accueil.php');
            }
        }
    }
}
