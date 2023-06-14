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

if (isset($_POST['ajouter_recette'])) { // Vérifie si l'utilisateur est connecté et si le bouton d'ajout de recette a été cliqué
    $nom = $_POST['nom']; // Récupère le nom de la recette depuis le formulaire
    $rincageTemps1 = $_POST['rincage_temps1']; // Récupère le temps de rinçage de l'étape 1 depuis le formulaire
    $rincageTemps3 = $_POST['rincage_temps3'];
    $rincageTemps5 = $_POST['rincage_temps5'];
    $rincageTemps7 = $_POST['rincage_temps7'];
    $produit2 = $_POST['produit2']; // Récupère l'ID du produit de l'étape 2 depuis le formulaire
    $produit4 = $_POST['produit4'];
    $produit6 = $_POST['produit6'];
    $lavageDegres2 = $_POST['lavage_degres2']; // Récupère la température de lavage de l'étape 2 depuis le formulaire
    $lavageDegres4 = $_POST['lavage_degres4'];
    $lavageDegres6 = $_POST['lavage_degres6'];
    $lavageTemps2 = $_POST['lavage_temps2']; // Récupère le temps de lavage de l'étape 2 depuis le formulaire
    $lavageTemps4 = $_POST['lavage_temps4'];
    $lavageTemps6 = $_POST['lavage_temps6'];

    // Requête SQL pour insérer la recette dans la base de données
    $requete = "INSERT INTO Recette (nom, rincage_temps1, rincage_temps3, rincage_temps5, rincage_temps7, id_produit2, id_produit4, id_produit6, lavage_temps2, lavage_temps4, lavage_temps6, lavage_degres2, lavage_degres4, lavage_degres6) VALUES (" . $bdd->quote($nom) . ",'" . $rincageTemps1 . "','" . $rincageTemps3 . "','" . $rincageTemps5 . "','" . $rincageTemps7 . "', '" . $produit2 . "', '" . $produit4 . "', '" . $produit6 . "', '" . $lavageTemps2 . "', '" . $lavageTemps4 . "', '" . $lavageTemps6 . "', '" . $lavageDegres2 . "', '" . $lavageDegres4 . "', '" . $lavageDegres6 . "')";


    if ($bdd->query($requete)) { // Exécute la requête d'insertion dans la base de données
        echo "La recette a été ajoutée avec succès dans la base de données.";
    } else {
        echo "Erreur lors de l'ajout de la recette : " . $bdd->errorInfo()[2]; // Affiche un message d'erreur si l'ajout de la recette échoue
    }
}
?>


<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./CSS/style.css" media="screen" type="text/css" />
</head>

<body>
    <?php
    if (isset($_POST["ChoixModifierRecette"])) {
        $reqselectproduit = "SELECT `id`, `nom` FROM `Produit`";
        $resultselectproduit = $bdd->query($reqselectproduit);
    ?>
        <div id="background"></div>

        <div id="code-container1">

            <div align="center">

                <form action="" method="POST">

                    <a href="index.php"><img src="IMAGES/Tropicana 2.png" /></a>


                    <h2>Ajouter une recette de nettoyage</h2>
                    <label><b>Nom de la recette :</b></label>
                    <input type="text" placeholder="Nom de la recette" name="nom" required>



                    <h2>Etape 1</h2>
                    <h2>Rinçage</h2>
                    <label for="rincage_temps1"><b>Temps de rinçage :</b></label>
                    <input type="time" id="rincage_temps1" name="rincage_temps1" step="2">



                    <h2>Etape 2</h2>
                    <h2>Lavage</h2>
                    <label for="produit2"><b>Produits :</b></label>
                    <select id="produit2" name="produit2" required>
                        <?php
                        while ($tabproduit = $resultselectproduit->fetch()) {
                            echo "<option value=" . $tabproduit['id'] . ">" . $tabproduit['nom'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label for="lavage_degres2"><b>Degrés Celsius :</b></label>
                    <input type="number" id="lavage_degres2" name="lavage_degres2" required>
                    <br>
                    <label for="lavage_temps2"><b>Temps de lavage :</b></label>
                    <input type="time" id="lavage_temps2" name="lavage_temps2" step="2">



                    <h2>Etape 3</h2>
                    <h2>Rinçage</h2>
                    <label for="rincage_temps3"><b>Temps de rinçage :</b></label>
                    <input type="time" id="rincage_temps3" name="rincage_temps3" step="2">



                    <h2>Etape 4</h2>
                    <h2>Lavage</h2>
                    <label for="produit4"><b>Produits :</b></label>
                    <select id="produit4" name="produit4" required>
                        <?php
                        $resultselectproduit->execute();
                        while ($tabproduit = $resultselectproduit->fetch()) {
                            echo "<option value=" . $tabproduit['id'] . ">" . $tabproduit['nom'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label for="lavage_degres4"><b>Degrés Celsius :</b></label>
                    <input type="number" id="lavage_degres4" name="lavage_degres4" required>
                    <br>
                    <label for="lavage_temps4"><b>Temps de lavage :</b></label>
                    <input type="time" id="lavage_temps4" name="lavage_temps4" step="2">



                    <h2>Etape 5</h2>
                    <h2>Rinçage</h2>
                    <label for="rincage_temps5"><b>Temps de rinçage :</b></label>
                    <input type="time" id="rincage_temps5" name="rincage_temps5" step="2">



                    <h2>Etape 6</h2>
                    <h2>Lavage</h2>
                    <label for="produit6"><b>Produits :</b></label>
                    <select id="produit6" name="produit6" required>
                        <?php
                        $resultselectproduit->execute();
                        while ($tabproduit = $resultselectproduit->fetch()) {
                            echo "<option value=" . $tabproduit['id'] . ">" . $tabproduit['nom'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label for="lavage_degres6"><b>Degrés Celsius :</b></label>
                    <input type="number" id="lavage_degres6" name="lavage_degres6" required>
                    <br>
                    <label for="lavage_temps6"><b>Temps de lavage :</b></label>
                    <input type="time" id="lavage_temps6" name="lavage_temps6" step="2">



                    <h2>Etape 7</h2>
                    <h2>Rinçage a l'eau potable et stérile pH non neutre</h2>
                    <label for="rincage_temps7"><b>Temps de rinçage :</b></label>
                    <input type="time" id="rincage_temps7" name="rincage_temps7" step="2">
                    <input type="submit" name="ajouter_recette" value="Ajouter la recette">


                </form>
                <form action="" method="POST">
                    <input type="submit" id='Disconnect' name="Deco" value='Déconnexion'>
                </form>
            </div>
        </div>
    <?php
    }

    ?>
    <div id="background"></div>

    <div id="code-container3">
        <?php
        $reqselectproduit = "SELECT `id`, `nom` FROM `Produit`";
        $resultselectproduit = $bdd->query($reqselectproduit);

        if (isset($_SESSION["id"])) {
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
        } else {
            if ($error) {
                echo $error;
            }
?>

<?php
        }
?>
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