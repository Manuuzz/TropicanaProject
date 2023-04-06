<?php
// Définir une classe User
class User
{
    // Déclarer les variables privées pour stocker les informations de l'utilisateur
    private $id_;
    private $nom_utilisateur_;
    private $mot_de_passe_;

    // Définir le constructeur de la classe User qui prend trois arguments : l'identifiant, le nom d'utilisateur et le mot de passe de l'utilisateur
    public function __construct($new_id, $new_nom_utilisteur, $new_mot_de_passe)
    {
        // Initialiser les variables privées de la classe avec les valeurs passées en argument du constructeur
        $this->id_ = $new_id;
        $this->nom_utilisateur_ = $new_nom_utilisteur;
        $this->mot_de_passe_ = $new_mot_de_passe;
    }

    // Définir une méthode de connexion qui prend un nom d'utilisateur et un mot de passe en argument et renvoie l'identifiant de l'utilisateur si les informations d'identification sont correctes, sinon elle renvoie false
    public function connexion($nom_utilisateur, $mot_de_passe)
    {
        // Construire la requête SQL pour récupérer les informations de l'utilisateur à partir de la table User en utilisant le nom d'utilisateur et le mot de passe fournis
        $requete = "SELECT * FROM User where nom_utilisateur = '" . $nom_utilisateur . "' and mot_de_passe = '" . $mot_de_passe . "' ";
        // Exécuter la requête SQL en utilisant l'objet PDO $bdd (défini en dehors de la classe)
        $rep = $GLOBALS['bdd']->query($requete);
        // Vérifier si la requête a retourné des résultats (c'est-à-dire que le nom d'utilisateur et le mot de passe sont corrects)
        if ($rep->rowCount() > 0) // nom d'utilisateur et mot de passe correctes
        {
            // Récupérer la première ligne des résultats de la requête (car il ne devrait y avoir qu'un seul utilisateur correspondant)
            $tab = $rep->fetch();
            // Retourner l'identifiant de l'utilisateur
            return $tab["id"];
        } else {
            // Si le nom d'utilisateur et le mot de passe ne correspondent à aucun enregistrement de la table User, renvoyer false
            return false;
        }
    }
}
