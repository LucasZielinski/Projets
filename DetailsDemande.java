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
public class DetailsDemande {
    private Demande uneDemande;
    private Medicament unMedicament;
    private int quantite;

    public DetailsDemande(Demande uneDemande, Medicament unMedicaments, int quantite) {
        this.uneDemande = uneDemande;
        this.unMedicament = unMedicaments;
        this.quantite = quantite;
    }

    public Demande getUneDemande() {
        return uneDemande;
    }

    public Medicament getUnMedicament() {
        return unMedicament;
    }

    public int getQuantite() {
        return quantite;
    }

    public void setUneDemande(Demande uneDemande) {
        this.uneDemande = uneDemande;
    }

    public void setUnMedicament(Medicament unMedicaments) {
        this.unMedicament = unMedicaments;
    }

    public void setQuantite(int quantite) {
        this.quantite = quantite;
    }
}
