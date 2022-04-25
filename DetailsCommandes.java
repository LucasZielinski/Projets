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
public class DetailsCommandes {
    private Commande uneCommande;
    private Medicament unMedicament;
    private int quantite;

    public DetailsCommandes(Commande uneCommande, Medicament unMedicament, int quantite) {
        this.uneCommande = uneCommande;
        this.unMedicament = unMedicament;
        this.quantite = quantite;
    }

    public Commande getUneCommande() {
        return uneCommande;
    }

    public Medicament getUnMedicament() {
        return unMedicament;
    }

    public int getQuantite() {
        return quantite;
    }

    public void setUneCommande(Commande uneCommande) {
        this.uneCommande = uneCommande;
    }

    public void setUnMedicament(Medicament unMedicament) {
        this.unMedicament = unMedicament;
    }

    public void setQuantite(int quantite) {
        this.quantite = quantite;
    }
    
    
}
