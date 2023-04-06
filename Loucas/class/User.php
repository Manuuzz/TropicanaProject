<?php class User {
    private $id_;
    private $nom_utilisateur_;
    private $mot_de_passe_;

    public function __construct ($new_id,$new_nom_utilisteur,$new_mot_de_passe)
    {
        $this->id_= $new_id;
        $this->nom_utilisateur_=$new_nom_utilisteur;
        $this->mot_de_passe_=$new_mot_de_passe;
    }

    public function connexion ($nom_utilisateur,$mot_de_passe)
    {
        $requete = "SELECT * FROM User where nom_utilisateur = '".$nom_utilisateur."' and mot_de_passe = '".$mot_de_passe."' ";
        $rep = $GLOBALS['bdd']->query($requete); 
        if($rep->rowCount()>0) // nom d'utilisateur et mot de passe correctes
        {
            $tab = $rep->fetch();
            return $tab["id"];
            
        }else{
            return false;
        }
        
    }
        
}
