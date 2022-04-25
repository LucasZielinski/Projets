/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

/**
 *
 * @author sio1
 */
public class Commande {
    private int refCommandes;
    private Fournisseur unFournisseur;
    public String date;
    public Employe unEmploye;

    public Commande(int refCommandes, Fournisseur unFournisseur, String date, Employe unEmploye) {
        this.refCommandes = refCommandes;
        this.unFournisseur = unFournisseur;
        this.date = date;
        this.unEmploye = unEmploye;
    }

    public String getDate() {
        return date;
    }

    public Employe getUnEmploye() {
        return unEmploye;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public void setUnEmploye(Employe unEmploye) {
        this.unEmploye = unEmploye;
    }

    public int getRefCommandes() {
        return refCommandes;
    }

    public void setRefCommandes(int refCommandes) {
        this.refCommandes = refCommandes;
    }

    public Fournisseur getUnFournisseur() {
        return unFournisseur;
    }

    public void setUnFournisseur(Fournisseur unFournisseur) {
        this.unFournisseur = unFournisseur;
    }
    
    public String toString(){
        return "Commande : "+refCommandes+" Date : "+date+" ID Fournisseur : "+
                unFournisseur.getIdFournisseur()+" ID Employé : "+unEmploye.getIdEmploye();
    }
}
