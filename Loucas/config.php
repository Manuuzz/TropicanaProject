<?php 


        try 
    {
        $GLOBALS['bdd'] = new PDO("mysql:host=localhost;dbname=tropicana_bdd;charset=utf8", "root", "");


    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }



?>
