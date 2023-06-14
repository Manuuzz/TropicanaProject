<?php
session_start(); // Démarre une session

include("CLASS/User.php"); // Inclut la classe User

$error = false; // Variable pour stocker les éventuelles erreurs

if (isset($_POST['Deco'])) { // Vérifie si le bouton de déconnexion a été cliqué
    session_unset(); // Supprime toutes les variables de session
    session_destroy(); // Détruit la session
    header("location:index.php"); // Redirige vers la page d'accueil
}

// Informations de connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name = 'tropicana_bdd';
$db_host = 'localhost';

try {
    $GLOBALS['bdd'] = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name . ";", $db_username, $db_password); // Connexion à la base de données
    $username = $_POST['username'] ?? 0; // Récupère le nom d'utilisateur du formulaire ou met 0 par défaut
    $password = $_POST['password'] ?? 0; // Récupère le mot de passe du formulaire ou met 0 par défaut

    $TheUser = new User(null, null, null); // Crée une instance de la classe User
    $reponse = $TheUser->connexion($username, $password); // Appelle la méthode "connexion" pour vérifier les identifiants

    if ($reponse) { // Si la méthode renvoie une réponse (identifiants valides)
        $_SESSION["id"] = $reponse; // Stocke l'ID utilisateur dans la variable de session
        $error = false; // Pas d'erreur
    }
} catch (Exception $th) {
    echo $th->getMessage(); // Affiche un message d'erreur si la connexion à la base de données échoue
}

if (isset($_POST["ConsulterRecette"])) {
?>
    <div align="center">
        <form action="" method="POST">
            <a href="index.php"><img src="IMAGES/Tropicana 2.png" /></a>

            <?php
            $sql = "SELECT id, nom FROM recette";
            // Requête SQL pour récupérer les données de la table "recette"
            $result = $GLOBALS['bdd']->query($sql);
            ?>
            <select id="produit2" name="produit2" required>
                <?php
                while ($tabrecette = $result->fetch()) {
                    echo "<option value=" . $tabrecette['id'] . ">" . $tabrecette['nom'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" id='ChoixModifierRecette' name="ChoixModifierRecette" value='Modifier la recette'>
            <?php
            // Vérification s'il y a des résultats
            if ($result->rowCount() > 0) {
                // Affichage des données pour chaque ligne de résultat
                while ($row = $result->fetch()) {
                    echo "Nom : " . $row["nom"] . "<br>";
                }
            } else {
                echo "Aucun résultat trouvé.";
            }

            // Fermeture du curseur de résultat
            $result->closeCursor();
            ?>

            <form action="" method="POST">
                <input type="submit" id='Disconnect' name="Deco" value='Déconnexion'>
            </form>
    </div>
    </div>

<?php
} else 
            if ($error) {
    echo $error;
}
if (isset($_POST["DeleteRecette"])){
    ?>
    <div align="center">
        <form action="" method="POST">
            <a href="index.php"><img src="IMAGES/Tropicana 2.png" /></a>

            <?php
            $sql = "SELECT id, nom FROM recette";
            // Requête SQL pour récupérer les données de la table "recette"
            $result = $GLOBALS['bdd']->query($sql);
            ?>
            <select id="produit2" name="produit2" required>
                <?php
                while ($tabrecette = $result->fetch()) {
                    echo "<option value=" . $tabrecette['id'] . ">" . $tabrecette['nom'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" id='ChoixSupprimerRecette' name="ChoixSupprimerRecette" value='Supprimer la recette'>
            <?php
            // Vérification s'il y a des résultats
            if ($result->rowCount() > 0) {
                // Affichage des données pour chaque ligne de résultat
                while ($row = $result->fetch()) {
                    echo "Nom : " . $row["nom"] . "<br>";
                }
            } else {
                echo "Aucun résultat trouvé.";
            }

            // Fermeture du curseur de résultat
            $result->closeCursor();
            ?>

            <form action="" method="POST">
                <input type="submit" id='Disconnect' name="Deco" value='Déconnexion'>
            </form>
    </div>
</div>
<?php
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./CSS/style.css" media="screen" type="text/css" />
</head>

<body>
    <div id="background"></div>

    <div id="code-container2">
        <?php
    if (isset($_SESSION["id"])) {
        ?>
            <div align="center">
                <form action="" method="POST">
                    <a href="index.php"><img src="IMAGES/Tropicana 2.png" /></a>
                </form>
                <form action="" method="POST">
                    <a href="AjoutRecette.php"><img src="IMAGES/AddRecette.png" /></a>
                    <a href="ConsulterRecette.php" name="ConsulterRecette"><img src="IMAGES/ModifyRecette.png" /></a>
                    <input type="submit" name="DeleteRecette" value="Supprimer Recette">
                    <input type="submit" id='Disconnect' name="Deco" value='Déconnexion'>
                </form>
            </div>

        <?php
    } else {
        if ($error) {
            echo $error;
        }
        ?>
            <form action="" method="POST">
                <div align="center">
                    <img src="IMAGES/Tropicana.png" alt="Logo Tropicana">
                    <h1>Connexion</h1>
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                    <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                    <input type="submit" id='submit' name="CONNECT" value='Connexion'>
                </div>
            </form>
        <?php
    }
        ?>
    </div>
    </div>

    <script>
        window.addEventListener('mousemove', moveBackground);

        function moveBackground(event) {
            var background = document.getElementById('background');
            var mouseX = event.clientX;
            var mouseY = event.clientY;
            var windowWidth = window.innerWidth;
            var windowHeight = window.innerHeight;
            var percentX = (mouseX / windowWidth) * 100;
            var percentY = (mouseY / windowHeight) * 100;
            background.style.backgroundPosition = percentX + '% ' + percentY + '%';
        }
    </script>
</body>

</html>