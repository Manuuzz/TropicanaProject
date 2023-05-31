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