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
public class Demande {

    private int idDemande;
    private Employe unEmploye;
    private String date;
    private int valide;

    public Demande(int idDemande, Employe unEmploye, String pDate, int pValide) {
        this.idDemande = idDemande;
        this.unEmploye = unEmploye;
        this.date = pDate;
        this.valide = pValide;
    }

    public int getIdDemande() {
        return idDemande;
    }

    public void setIdDemande(int idDemande) {
        this.idDemande = idDemande;
    }

    public Employe getUnEmploye() {
        return unEmploye;
    }

    public void setUnEmploye(Employe unEmploye) {
        this.unEmploye = unEmploye;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getValide() {
        return valide;
    }

    public void setValide(int valide) {
        this.valide = valide;
    }

    @Override
    public String toString() {
        String bool = null;
        if (valide == 1) {
            bool = "Validé";
        } else if (valide == 2) {
            bool = "Refusé";
        } else if (valide == 0) {
            bool = "En cours de validation";
        }
        return ("ID Demande : " + idDemande + " ID Employé : " + unEmploye.getIdEmploye() + " Date : " + date + " " + bool);
    }

}
