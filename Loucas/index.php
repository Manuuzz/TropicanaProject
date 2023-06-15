<?php
session_start();

?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style.css" media="screen" type="text/css" />
</head>

<body>
    <div id="background"></div>

    <div id="code-container2">

        <?php

        require_once 'config.php'; // appele de la bdd
        $GLOBALS['bdd'] = $bdd;

        $_SESSION['Connexion'] = false;


        ?>



        <?php

        //appele de la classe User

        include("CLASS/User.php");
        $TheUser = new User(null, null, null);

        include("CLASS/Recette.php");
        $TheRecette = new Recette(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

        //gère la déconnexion

        if (isset($_POST['deconnexion'])) {
            // Le bouton de déconnexion a été cliqué
            $TheUser->deconnexion();
            $_SESSION['Connexion'] = false;
        }

        //traitement du formulaire de connexion

        if (isset($_POST['submit'])) {

            $resultat = $TheUser->connexion($_POST['identifiant'], $_POST['password']);

            if ($resultat->rowCount() > 0) {
                $_SESSION['logged_in'] = true;
            } else {
                echo "Identifiant ou mot de passe incorrect";
            }

            //$verif = " SELECT * FROM user WHERE identifiant='".$identifiant."' AND password ='".$password."'";
            //$resultat = $GLOBALS['bdd'] -> query($verif);

        }



        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            if (isset($_POST["submit"])) {
        ?>
                <div align="center">
                    <form action="" method="POST">
                        <a href="index.php"><img src="IMAGES/Tropicana 2.png" /></a>
                    </form>
                    <form action="" method="POST">
                        <input type="submit" name="AjouterRecette" value="Ajouter une Recette">
                        <input type="submit" name="ModifierRecette" value="Modifier une Recette">
                        <input type="submit" name="DeleteRecette" value="Supprimer Recette">
                    </form>
                </div>

            <?php
            }
            if (isset($_POST["ChoixSupprimerRecette"])) {
                echo $_POST["produit2"];
                $TheRecette->supprimer($_POST["produit2"]);
            }
            if (isset($_POST["DeleteRecette"])) {
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
                            echo "Aucun recette trouver.";
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
            if (isset($_POST["ajouter_recette"])) {
                $nom = $_POST['nom']; // Récupère le nom de la recette depuis le formulaire
                $rincageTemps1 = $_POST['rincage_temps1']; // Récupère le temps de rinçage de l'étape 1 depuis le formulaire
                $rincageTemps3 = $_POST['rincage_temps3']; // Récupère le temps de rinçage de l'étape 3 depuis le formulaire
                $rincageTemps5 = $_POST['rincage_temps5']; // Récupère le temps de rinçage de l'étape 5 depuis le formulaire
                $rincageTemps7 = $_POST['rincage_temps7']; // Récupère le temps de rinçage de l'étape 7 depuis le formulaire
                $produit2 = $_POST['produit2']; // Récupère l'ID du produit de l'étape 2 depuis le formulaire
                $produit4 = $_POST['produit4']; // Récupère l'ID du produit de l'étape 4 depuis le formulaire
                $produit6 = $_POST['produit6']; // Récupère l'ID du produit de l'étape 6 depuis le formulaire
                $lavageDegres2 = $_POST['lavage_degres2']; // Récupère la température de lavage de l'étape 2 depuis le formulaire
                $lavageDegres4 = $_POST['lavage_degres4']; // Récupère la température de lavage de l'étape 4 depuis le formulaire
                $lavageDegres6 = $_POST['lavage_degres6']; // Récupère la température de lavage de l'étape 6 depuis le formulaire
                $lavageTemps2 = $_POST['lavage_temps2']; // Récupère le temps de lavage de l'étape 2 depuis le formulaire
                $lavageTemps4 = $_POST['lavage_temps4']; // Récupère le temps de lavage de l'étape 4 depuis le formulaire
                $lavageTemps6 = $_POST['lavage_temps6']; // Récupère le temps de lavage de l'étape 6 depuis le formulaire

                // Requête SQL pour insérer la recette dans la base de données
                $TheRecette->ajouter(
                    $nom,
                    $rincageTemps1,
                    $rincageTemps3,
                    $rincageTemps5,
                    $rincageTemps7,
                    $produit2,
                    $produit4,
                    $produit6,
                    $lavageTemps2,
                    $lavageTemps4,
                    $lavageTemps6,
                    $lavageDegres2,
                    $lavageDegres4,
                    $lavageDegres6
                );
            }
            if (isset($_POST["AjouterRecette"])) {
                $reqselectproduit = "SELECT id, nom FROM Produit";
                $resultselectproduit = $bdd->query($reqselectproduit);
?>

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

    </div>


<?php
            }
            if (isset($_POST["modifier_recette"])) {
                $TheRecette->modifier(
                    $_SESSION["produit2"],
                    $_POST["nom"],
                    $_POST["rincage_temps1"],
                    $_POST["rincage_temps3"],
                    $_POST["rincage_temps5"],
                    $_POST["rincage_temps7"],
                    $_POST["produit2"],
                    $_POST["produit4"],
                    $_POST["produit6"],
                    $_POST["lavage_temps2"],
                    $_POST["lavage_temps4"],
                    $_POST["lavage_temps6"],
                    $_POST["lavage_degres2"],
                    $_POST["lavage_degres4"],
                    $_POST["lavage_degres6"]
                );
            }
            if (isset($_POST["ChoixModifierRecette"])) {
                $_SESSION["produit2"] = $_POST["produit2"];
                $reqselectproduit = "SELECT id, nom FROM Produit";
                $resultselectproduit = $bdd->query($reqselectproduit);
?>
    <div align="center">

        <form action="" method="POST">

            <a href="index.php"><img src="IMAGES/Tropicana 2.png" /></a>


            <h2>Modifier une recette de nettoyage</h2>
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
            <input type="submit" name="modifier_recette" value="Modifier la recette">


        </form>

    </div>
    </div>
<?php
            }
            if (isset($_POST["ModifierRecette"])) {
                $reqselectproduit = "SELECT `id`, `nom` FROM `Produit`";
                $resultselectproduit = $bdd->query($reqselectproduit);

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
            }
?>

<?php
        } else {
?>
    <div class="wrapper">

        <div class="form-container">
            <div class="slide-controls">
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">

                <form action="#" class="login" method="POST">
                    <div align="center">
                        <img src="IMAGES/Tropicana.png" alt="Logo Tropicana">
                        <h1>Connexion</h1>
                        <label><b>Nom d'utilisateur</b></label>
                        <div class="field">
                            <input type="text" placeholder="Identifiant" name="identifiant" required>
                        </div>
                        <label><b>Mot de passe</b></label>
                        <div class="field">
                            <input type="password" placeholder="Mot de Passe" name="password" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Connexion" name="submit">
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
<?php
        }



        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>


    <form action="" method="POST">
        <input type="submit" value="Déconnexion" name="deconnexion">
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