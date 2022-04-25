package com.example.jacletgestionrendezvous;

public class Consultation {
    private String id;
    private String dateHeure;
    private String motif;
    private String etat;
    private String duree;
    private String medecin;
    private String patient;

    public Consultation(String id, String dateHeure, String motif, String etat, String duree, String medecin, String patient) {
        this.id = id;
        this.dateHeure = dateHeure;
        this.motif = motif;
        this.etat = etat;
        this.duree = duree;
        this.medecin = medecin;
        this.patient = patient;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getDateHeure() {
        return dateHeure;
    }

    public void setDateHeure(String dateHeure) {
        this.dateHeure = dateHeure;
    }

    public String getMotif() {
        return motif;
    }

    public void setMotif(String motif) {
        this.motif = motif;
    }

    public String getEtat() {
        return etat;
    }

    public void setEtat(String etat) {
        this.etat = etat;
    }

    public String getDuree() {
        return duree;
    }

    public void setDuree(String duree) {
        this.duree = duree;
    }

    public String getMedecin() {
        return medecin;
    }

    public void setMedecin(String medecin) {
        this.medecin = medecin;
    }

    public String getPatient() {
        return patient;
    }

    public void setPatient(String patient) {
        this.patient = patient;
    }

    @Override
    public String toString() {
        return  "date:" + dateHeure +
                ", motif:" + motif +
                ", etat:" + etat +
                ", duree:" + duree;
    }
}
