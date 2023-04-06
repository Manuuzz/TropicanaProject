<?php
// On inclut la classe User pour pouvoir l'utiliser
include("./class/User.php");

// On démarre une session
session_start();

// On initialise la variable d'erreur à false
$error = false;

// Si l'utilisateur a cliqué sur le bouton de déconnexion, on détruit la session
if (isset($_POST['Deco'])) {
    session_unset();
    session_destroy();
}

// Si l'utilisateur a soumis le formulaire de connexion, on essaie de le connecter
if (isset($_POST['CONNECT'])) {

    // On définit les informations de connexion à la base de données
    $db_username = 'TropicanaWEB';
    $db_password = 'TropicanaWEB';
    $db_name = 'Tropicana';
    $db_host = '192.168.65.9';

    try {
        // On se connecte à la base de données
        $GLOBALS['bdd'] = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name . ";", $db_username, $db_password);

        // On récupère les informations du formulaire et on les sécurise
        $username = $_POST['username'];
        $password = $_POST['password'];

        // On crée un nouvel objet User et on essaie de connecter l'utilisateur
        $TheUser = new User(null, null, null);
        $reponse = $TheUser->connexion($username, $password);

        // Si la connexion a réussi, on stocke l'ID de l'utilisateur dans la session et on met l'erreur à false
        if ($reponse) {
            $_SESSION["id"] = $reponse;
            $error = false;
        } else {
            // Sinon, on met un message d'erreur dans la variable $error
            $error = "mauvais mdp ou login";
        }
    } catch (Exception $th) {
        // En cas d'erreur lors de la connexion à la base de données, on affiche le message d'erreur
        echo $th->getMessage();
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <!-- On importe le fichier de style CSS -->
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
</head>

<body>
    <div id="container">
        <?php
        // Si l'utilisateur est connecté, on affiche la page principale
        if (isset($_SESSION["id"])) {
            echo "page principale";
        ?>
            <!-- On affiche le bouton de déconnexion -->
            <form action="" method="POST">
                <input type="submit" id='Disconnect' name="Deco" value='Disconnect'>
            </form>
        <?php
        } else {
            // Sinon, on affiche le formulaire de connexion
            if ($error) {
                echo $error;
            }
        ?>
            <form action="" method="POST">
                <div align="center">
                    <!-- On affiche le logo de Tropicana -->
                    <img src="images/Tropicana.png" alt="Logo Tropicana">
                    <h1>Connexion</h1>
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                    <input type="submit" id='submit' name="CONNECT" value='LOGIN'>

            </form>
        <?php

        }
        ?>
    </div>
</body>

</html>