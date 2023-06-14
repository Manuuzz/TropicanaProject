<?php

class Recette
{
    private $id_;
    private $nom_;
    private $rincageTemps1_;
    private $rincageTemps3_;
    private $rincageTemps5_;
    private $rincageTemps7_;
    private $produit2_;
    private $produit4_;
    private $produit6_;
    private $lavageDegres2_;
    private $lavageDegres4_;
    private $lavageDegres6_;
    private $lavageTemps2_;
    private $lavageTemps4_;
    private $lavageTemps6_;

    public function __construct($Newid, $Newnom, $NewrincageTemps1, $NewrincageTemps3, $NewrincageTemps5, $NewrincageTemps7, $Newproduit2, $Newproduit4, $Newproduit6, $NewlavageDegres2, $NewlavageDegres4, $NewlavageDegres6, $NewlavageTemps2, $NewlavageTemps4, $NewlavageTemps6)
    {
        $this->id_ = $Newid;
        $this->nom_ = $Newnom;
        $this->rincageTemps1_ = $NewrincageTemps1;
        $this->rincageTemps3_ = $NewrincageTemps3;
        $this->rincageTemps5_ = $NewrincageTemps5;
        $this->rincageTemps7_ = $NewrincageTemps7;
        $this->produit2_ = $Newproduit2;
        $this->produit4_ = $Newproduit4;
        $this->produit6_ = $Newproduit6;
        $this->lavageDegres2_ = $NewlavageDegres2;
        $this->lavageDegres4_ = $NewlavageDegres4;
        $this->lavageDegres6_ = $NewlavageDegres6;
        $this->lavageTemps2_ = $NewlavageTemps2;
        $this->lavageTemps4_ = $NewlavageTemps4;
        $this->lavageTemps6_ = $NewlavageTemps6;
    }

    public function ajouter($nom, $rincage_temps1, $rincage_temps3, $rincage_temps5, $rincage_temps7, $id_produit2, $id_produit4, $id_produit6, $lavage_temps2, $lavage_temps4, $lavage_temps6, $lavage_degres2, $lavage_degres4, $lavage_degres6)
    {
        $reqAjouterRecette = "INSERT INTO Recette (nom, rincage_temps1, rincage_temps3, rincage_temps5, rincage_temps7, id_produit2, id_produit4, id_produit6, lavage_temps2, lavage_temps4, lavage_temps6, lavage_degres2, lavage_degres4, lavage_degres6) VALUES ('" . $nom . "','" . $rincage_temps1 . "','" . $rincage_temps3 . "','" . $rincage_temps5 . "','" . $rincage_temps7 . "', '" . $id_produit2 . "', '" . $id_produit4 . "', '" . $id_produit6 . "', '" . $lavage_temps2 . "', '" . $lavage_temps4 . "', '" . $lavage_temps6 . "','" . $lavage_degres2 . "', '" . $lavage_degres4 . "', '" . $lavage_degres6 . "')";
        $resultAjouterRecette = $GLOBALS['bdd']->query($reqAjouterRecette);
    }

    public function modifier($id, $nom, $rincage_temps1, $rincage_temps3, $rincage_temps5, $rincage_temps7, $id_produit2, $id_produit4, $id_produit6, $lavage_temps2, $lavage_temps4, $lavage_temps6, $lavage_degres2, $lavage_degres4, $lavage_degres6)
    {
        $reqModifierRecette = "UPDATE `recette` SET `nom`='" . $nom . "',`id_Produit2`='" . $id_produit2 . "',`id_Produit4`='" . $id_produit4 . "',`id_Produit6`='" . $id_produit6 . "',`rincage_temps1`='" . $rincage_temps1 . "',`rincage_temps3`='" . $rincage_temps3 . "',`rincage_temps5`='" . $rincage_temps5. "',`rincage_temps7`='" . $rincage_temps7 . "',`lavage_temps2`='" . $lavage_temps2 . "',`lavage_temps4`='" . $lavage_temps4 . "',`lavage_temps6`='" . $lavage_temps6 . "',`lavage_degres2`='" . $lavage_degres2 . "',`lavage_degres4`='" . $lavage_degres4 . "',`lavage_degres6`='" . $lavage_degres6 . "' WHERE id='" . $id . "'";
        $resultModifierRecette = $GLOBALS['bdd']->query($reqModifierRecette);
    }
    public function supprimer($id)
    {
        $reqSupprimerRecette = "DELETE FROM `recette` WHERE id='" . $id . "'";
        $resultSupprimerRecette = $GLOBALS['bdd']->query($reqSupprimerRecette);
    }
}