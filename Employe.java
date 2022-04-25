/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

/**
 *
 * @author sio2
 */
public class Employe {
    private int idEmploye;
    private String nom;
    private String prenom;
    private int age;
    private String login;
    private String mdp;
    private int idService;
    private String role;

    public Employe(int idEmploye, String nom, String prenom, int age, String login, String mdp, int idService, String role) {
        this.idEmploye = idEmploye;
        this.nom = nom;
        this.prenom = prenom;
        this.age = age;
        this.login = login;
        this.mdp = mdp;
        this.idService = idService;
        this.role = role;
    }

    public int getIdEmploye() {
        return idEmploye;
    }

    public void setIdEmploye(int idEmploye) {
        this.idEmploye = idEmploye;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public int getAge() {
        return age;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public String getLogin() {
        return login;
    }

    public void setLogin(String login) {
        this.login = login;
    }

    public String getMdp() {
        return mdp;
    }

    public void setMdp(String mdp) {
        this.mdp = mdp;
    }

    public int getIdService() {
        return idService;
    }

    public void setIdService(int idService) {
        this.idService = idService;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }
    
}
