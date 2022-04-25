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
public class Medicament {
    private int idMedoc;
    private String libelle;
    private String description;
    private int nbStocks;
    private String localisation;

    public Medicament(int idMedoc, String libelle, String description, int nbStocks, String localisation) {
        this.idMedoc = idMedoc;
        this.libelle = libelle;
        this.description = description;
        this.nbStocks = nbStocks;
        this.localisation = localisation;
    }

    public int getIdMedoc() {
        return idMedoc;
    }

    public void setIdMedoc(int idMedoc) {
        this.idMedoc = idMedoc;
    }

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getNbStocks() {
        return nbStocks;
    }

    public void setNbStocks(int nbStocks) {
        this.nbStocks = nbStocks;
    }

    public String getLocalisation() {
        return localisation;
    }

    public void setLocalisation(String localisation) {
        this.localisation = localisation;
    }
    
    public String toStringInfo(){
        return "Id: "+idMedoc+" - "+libelle+" - stock disponibles: "+nbStocks+" - localisation: "+localisation;
    }
}
