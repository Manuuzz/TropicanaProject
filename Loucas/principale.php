<html>

<head>
    <!-- Définir l'encodage des caractères pour être "utf-8" -->
    <meta charset="utf-8">
    <!-- Importer le fichier de style -->
    <link rel="stylesheet" href="./CSS/style.css" media="screen" type="text/css" />
</head>

<body style='background:#fff;'>
    <!-- Créer un conteneur pour le contenu de la page -->
    <div id="content">
        <!-- Vérifier si l'utilisateur est connecté -->
        <?php
        // Démarrer la session PHP
        session_start();
        // Vérifier si l'utilisateur est connecté en vérifiant si la variable de session 'username' est définie
        if ($_SESSION['username'] !== "") {
            // Si l'utilisateur est connecté, récupérer son nom d'utilisateur à partir de la variable de session
            $user = $_SESSION['username'];
            // Afficher un message de bienvenue avec le nom d'utilisateur
            echo "Bonjour $user, vous êtes connecté au Tropicana Admin Center";
        }
        ?>
        <!-- Ajouter un lien de déconnexion -->
        <a href='principale.php?deconnexion=true'><span>Déconnexion</span></a>
        <!-- Vérifier si l'utilisateur a cliqué sur le lien de déconnexion -->
        <?php
        if (isset($_GET['deconnexion'])) {
            // Si l'utilisateur a cliqué sur le lien de déconnexion, détruire la session PHP en appelant session_unset()
            // puis rediriger l'utilisateur vers la page de connexion en utilisant header("location:login.php");
            if ($_GET['deconnexion'] == true) {
                session_unset();
                header("location:index.php");
            }
        }
        // Si l'utilisateur est déjà connecté, récupérer son nom d'utilisateur à partir de la variable de session
        else if ($_SESSION['username'] !== "") {
            $user = $_SESSION['username'];
        }
        ?>
    </div>
</body>

</html>