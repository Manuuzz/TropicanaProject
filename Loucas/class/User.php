<?php

    class User
    {
        private $id_;
        private $nom_utilsateur_;
        private $mot_depasse_;

        public function __construct($Newid, $Newnom_utilsateur, $Newmot_de_passe)
        {
            $this->id_ = $Newid;
            $this->nom_utilsateur_= $Newnom_utilsateur;
            $this->mot_depasse_= $Newmot_de_passe;
        }

        public function connexion($nom_utilsateur, $mot_de_passe)
        {

            $verif = " SELECT * FROM user WHERE nom_utilisateur='".$nom_utilsateur."' AND mot_de_passe='".$mot_de_passe."'";
            $resultat = $GLOBALS['bdd'] -> query($verif);



            return $resultat;
        }

        public function deconnexion()
        {
            session_unset();
            session_destroy();

        }
    }