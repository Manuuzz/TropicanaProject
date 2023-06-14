<?php

class Recette {
    private $nom;
    private $rinçageTemps;
    private $produit;
    private $lavageDegres;
    private $lavageTemps;

    public function __construct($nom, $rinçageTemps, $produit, $lavageDegres, $lavageTemps) {
        $this->nom = $nom;
        $this->rinçageTemps = $rinçageTemps;
        $this->produit = $produit;
        $this->lavageDegres = $lavageDegres;
        $this->lavageTemps = $lavageTemps;
    }

    // Getters and Setters

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getRinçageTemps() {
        return $this->rinçageTemps;
    }

    public function setRinçageTemps($rinçageTemps) {
        $this->rinçageTemps = $rinçageTemps;
    }

    public function getProduit() {
        return $this->produit;
    }

    public function setProduit($produit) {
        $this->produit = $produit;
    }

    public function getLavageDegres() {
        return $this->lavageDegres;
    }

    public function setLavageDegres($lavageDegres) {
        $this->lavageDegres = $lavageDegres;
    }

    public function getLavageTemps() {
        return $this->lavageTemps;
    }

    public function setLavageTemps($lavageTemps) {
        $this->lavageTemps = $lavageTemps;
    }
}

?>