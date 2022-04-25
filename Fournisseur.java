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
public class Fournisseur {
    private int idFournisseur;
    private String nom;
    private String rue;
    private String cp;
    private String ville;
    private String tel;

    public Fournisseur(int idFournisseur, String nom, String rue, String cp, String ville, String tel) {
        this.idFournisseur = idFournisseur;
        this.nom = nom;
        this.rue = rue;
        this.cp = cp;
        this.ville = ville;
        this.tel = tel;
    }

    public int getIdFournisseur() {
        return idFournisseur;
    }

    public String getNom() {
        return nom;
    }

    public String getRue() {
        return rue;
    }

    public String getCp() {
        return cp;
    }

    public String getVille() {
        return ville;
    }

    public String getTel() {
        return tel;
    }

    public void setIdFournisseur(int idFournisseur) {
        this.idFournisseur = idFournisseur;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setRue(String rue) {
        this.rue = rue;
    }

    public void setCp(String cp) {
        this.cp = cp;
    }

    public void setVille(String ville) {
        this.ville = ville;
    }

    public void setTel(String tel) {
        this.tel = tel;
    }

    public String toString(){
        String adresse=rue+" "+cp+" "+ville;
        return "idFournisseur : "+idFournisseur+" Nom : "+nom+" Adresse : "+adresse+" Téléphone : "+tel;
    }
}
