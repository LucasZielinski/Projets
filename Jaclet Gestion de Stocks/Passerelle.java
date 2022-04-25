/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

/**
 *
 * @author sio1
 */
public class Passerelle {

    private static Connection pdo;
    private static Statement state;
    private static ResultSet res;

    public static void connectionPDO() {
        try {
            pdo = DriverManager.getConnection("jdbc:postgresql://192.168.1.245:5432/SLAM2022_JacletPharmacie", "guichard", "guichard");
        } catch (Exception e) {
            System.out.println(e);
            System.out.println("Erreur!");
        }
    }

    public static Employe Authentification(String login, String mdp) {
        if (pdo == null) {
            connectionPDO();
        }
        Employe unEmploye = null;
        try {
            state = pdo.createStatement();
            String requete = ("select * from employes where login=? and mdp=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setString(1, login);
            prepare.setString(2, mdp);
            res = prepare.executeQuery();
            res.next();
            unEmploye = new Employe(res.getInt(1), res.getString(2), res.getString(3), res.getInt(4), res.getString(5), res.getString(6), res.getInt(7), res.getString(8));
            return unEmploye;
        } catch (Exception e) {
            System.out.println(e);
            System.out.println("Erreur connexion!");
        }
        return unEmploye;
    }

    public static ArrayList<Commande> donnerToutesLesCommandes(){
        if(pdo==null){
            connectionPDO();
        }
        Commande uneCommande = null;
        ArrayList<Commande> lesCommandes=new ArrayList<Commande>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM commandes";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int id=jeuResultat.getInt(1);
                int idFournisseur=jeuResultat.getInt(2);
                String date=jeuResultat.getString(3);
                int idEmploye=jeuResultat.getInt(4);
                Fournisseur unFournisseur=new Fournisseur(idFournisseur,null,null,null,null,null);
                Employe unEmploye=new Employe(idEmploye,null,null,0,null,null,0,null);
                uneCommande = new Commande(id,unFournisseur,date,unEmploye);
                lesCommandes.add(uneCommande);
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesCommandes;
    }
    
    public static Commande donneUneCommande(int id){
        if(pdo==null){
            connectionPDO();
        }
        Commande uneCommande=null;
        try{
            String requete = ("select * from commandes where id_commande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1,id);
            res = prepare.executeQuery();
            res.next();
            int idFournisseur=res.getInt(2);
            String date=res.getString(3);
            int idEmploye=res.getInt(4);
            Fournisseur unFournisseur=new Fournisseur(idFournisseur,null,null,null,null,null);
            Employe unEmploye=new Employe(idEmploye,null,null,0,null,null,0,null);
            uneCommande=new Commande(id,unFournisseur,date,unEmploye);
        }
        catch(Exception e){
            System.out.println(e);
        }
        return uneCommande;
    }
    
    public static Demande donneUneDemande(int id){
        if(pdo==null){
            connectionPDO();
        }
        Demande uneDemande=null;
        try{
            String requete = ("select * from demandes where id_demande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1,id);
            res = prepare.executeQuery();
            res.next();
            int idEmploye=res.getInt(2);
            String date=res.getString(3);
            int valide=res.getInt(4);
            Employe unEmploye=new Employe(idEmploye,null,null,0,null,null,0,null);
            uneDemande=new Demande(id,unEmploye,date,valide);
        }
        catch(Exception e){
            System.out.println(e);
        }
        return uneDemande;
    }

    public static ArrayList<Demande> donnerLesDemandesParService(int idService) {
        connectionPDO();
        Demande uneDemande = null;
        ArrayList<Demande> lesDemandes = new ArrayList<Demande>();
        try {
            Statement state = pdo.createStatement();
            String requete = "SELECT id_demande,demandes.id_employe,date,valide "
                    + "FROM demandes "
                    + "JOIN employes ON demandes.id_employe = employes.id_employe "
                    + "JOIN services ON employes.id_service = services.id_service "
                    + "WHERE demandes.id_employe IN (SELECT id_service FROM employes WHERE id_service =?)";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, idService);
            res = prepare.executeQuery();
            while (res.next()) {
                int idDemande = res.getInt(1);
                int idEmploye = res.getInt(2);
                String date = res.getString(3);
                int bool = res.getInt(4);
                Employe unEmploye = new Employe(idEmploye, null, null, 0, null, null, 0, null);
                uneDemande = new Demande(idDemande, unEmploye, date, bool);
                lesDemandes.add(uneDemande);
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return lesDemandes;

    }

     public static ArrayList<String> donnerTousLesFournisseurs(){
        if(pdo==null){
            connectionPDO();
        }
        Fournisseur unFournisseur = null;
        ArrayList<String> lesFournisseurs=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM fournisseur";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int id=jeuResultat.getInt(1);
                String nom=jeuResultat.getString(2);
                String rue=jeuResultat.getString(3);
                String cp=jeuResultat.getString(4);
                String ville=jeuResultat.getString(5);
                String tel=jeuResultat.getString(6);
                unFournisseur=new Fournisseur(id,nom,rue,cp,ville,tel);
                lesFournisseurs.add(unFournisseur.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesFournisseurs;
    }

    public static ArrayList<String> donnerTousLesLibelleFournisseurs(){
        if(pdo==null){
            connectionPDO();
        }
        ArrayList<String> lesFournisseurs=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT nom FROM fournisseur ORDER BY id_fournisseur";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                String nom=jeuResultat.getString(1);
                lesFournisseurs.add(nom);
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesFournisseurs;
    }
    
    public static Integer donnerUnIdFournisseur(String libelle){
        if(pdo==null){
            connectionPDO();
        }
        int id=0;
        try{
            String requete = ("select id_fournisseur from fournisseur where nom=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setString(1,libelle);
            res = prepare.executeQuery();
            res.next();
            id=res.getInt(1);
        }
        catch(Exception e){
            System.out.println(e);
        }
        return id;
    }
    
    public static ArrayList<String> donnerTousLesLibelleMedoc(){
        if(pdo==null){
            connectionPDO();
        }
        ArrayList<String> lesMedocs=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT libelle FROM medicaments ORDER BY id_medoc";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                String nom=jeuResultat.getString(1);
                lesMedocs.add(nom);
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesMedocs;
    }
    
    public static Integer donnerUnIdMedoc(String libelle){
        if(pdo==null){
            connectionPDO();
        }
        int id=0;
        try{
            String requete = ("select id_medoc from medicaments where libelle=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setString(1,libelle);
            res = prepare.executeQuery();
            res.next();
            id=res.getInt(1);
        }
        catch(Exception e){
            System.out.println(e);
        }
        return id;
    }
    
    public static ArrayList<String> donnerTousLesLibelleEmployes(){
        if(pdo==null){
            connectionPDO();
        }
        ArrayList<String> lesEmployes=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT nom FROM employes ORDER BY id_employe";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                String nom=jeuResultat.getString(1);
                lesEmployes.add(nom);
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesEmployes;
    }
    
    public static Integer donnerUnIdEmploye(String libelle){
        if(pdo==null){
            connectionPDO();
        }
        int id=0;
        try{
            String requete = ("select id_employe from employes where nom=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setString(1,libelle);
            res = prepare.executeQuery();
            System.out.println(prepare);
            res.next();
            id=res.getInt(1);
        }
        catch(Exception e){
            System.out.println(e);
        }
        return id;
    }
    
    public static ArrayList<Demande> donnerToutesLesDemandes() {
        connectionPDO();
        Demande uneDemande = null;
        ArrayList<Demande> lesDemandes = new ArrayList<Demande>();
        try {
            Statement state = pdo.createStatement();
            String requete = "SELECT * FROM demandes";
            ResultSet jeuResultat = state.executeQuery(requete);
            while (jeuResultat.next()) {
                int idDemande = jeuResultat.getInt(1);
                int idEmploye = jeuResultat.getInt(2);
                String date = jeuResultat.getString(3);
                int bool = jeuResultat.getInt(4);
                Employe unEmploye = new Employe(idEmploye, null, null, 0, null, null, 0, null);
                uneDemande = new Demande(idDemande, unEmploye, date, bool);
                lesDemandes.add(uneDemande);
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return lesDemandes;

    }

    public static Service getService(int idService) {
        if (pdo == null) {
            connectionPDO();
        }
        Service leService = null;
        try {
            state = pdo.createStatement();
            String requete = ("select * from services where id_service=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, idService);
            res = prepare.executeQuery();
            res.next();
            leService = new Service(res.getInt(1), res.getString(2));
            return leService;
        } catch (Exception e) {
            System.out.println(e);
            System.out.println("Erreur connexion!");
        }
        return leService;
    }

    public static boolean ajouterDemande(Demande uneDemande){
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        if(verifIdDemande(uneDemande.getIdDemande())==false){
            bool=true;
        }
        else{
            try{
                String requete = ("INSERT INTO demandes (id_employe,date,valide) VALUES(?,?,0)");
                PreparedStatement prepare = pdo.prepareStatement(requete);
                prepare.setInt(1,uneDemande.getUnEmploye().getIdEmploye());
                prepare.setString(2,uneDemande.getDate());
                System.out.println(prepare);
                prepare.executeUpdate();
                bool=true;
             }
            catch(Exception e){
                System.out.println(e);
            }
        }
        System.out.println(bool);
        return bool;
    }

    public static boolean ajouterDetailsDemande(DetailsDemande unDetail) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = ("INSERT INTO detail_demandes VALUES(?,?,?)");
            System.out.println(requete);
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, unDetail.getUneDemande().getIdDemande());
            prepare.setInt(2, unDetail.getUnMedicament().getIdMedoc());
            prepare.setInt(3, unDetail.getQuantite());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static boolean ajouterCommande(Commande uneCommande){
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        if(verifIdCommande(uneCommande.getRefCommandes())==false){
            bool=true;
        }
        else{
            try{
                String requete="INSERT INTO commandes (id_fournisseur,date,id_employe) VALUES(?, ?, ?)";
                PreparedStatement prepare=pdo.prepareStatement(requete);
                prepare.setInt(1,uneCommande.getUnFournisseur().getIdFournisseur());
                prepare.setString(2,uneCommande.getDate());
                prepare.setInt(3,uneCommande.getUnEmploye().getIdEmploye());
                prepare.executeUpdate();
                bool=true;
             }
            catch(Exception e){
                System.out.println(e);
            }
        }    
        return bool;
    }
    
    public static boolean ajouterDetailsCommandes(DetailsCommandes unDetail) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "INSERT INTO detail_commandes VALUES(?,?,?)";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, unDetail.getUneCommande().getRefCommandes());
            prepare.setInt(2, unDetail.getUnMedicament().getIdMedoc());
            prepare.setInt(3, unDetail.getQuantite());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static void supprimerDemande(Demande uneDemande) {
        if (pdo == null) {
            connectionPDO();
        }
        try {
            if (uneDemande.getValide()!= 1) {
                String requete = "DELETE FROM detail_demandes WHERE id_demande=?";
                PreparedStatement prepare = pdo.prepareStatement(requete);
                prepare.setInt(1, uneDemande.getIdDemande());
                prepare.executeUpdate();
                String requete2 = "DELETE FROM demandes WHERE id_demande=?";
                PreparedStatement prepare2 = pdo.prepareStatement(requete2);
                prepare2.setInt(1, uneDemande.getIdDemande());
                prepare2.executeUpdate();
            } else {
                System.out.println("La demande a été validé");
            }
        } catch (Exception e) {
            System.out.println(e);
        }
    }

    public static boolean modifierCommande(Commande uneCommande) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "UPDATE commandes SET id_fournisseur=?, date=?, id_employe=? WHERE id_commande=?";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, uneCommande.getUnFournisseur().getIdFournisseur());
            prepare.setString(2, uneCommande.getDate());
            prepare.setInt(3, uneCommande.getUnEmploye().getIdEmploye());
            prepare.setInt(4, uneCommande.getRefCommandes());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static boolean modifierDetailsCommandes(DetailsCommandes unDetail) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "UPDATE detail_commandes SET qt=? WHERE id_commande=? AND id_medoc=?";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, unDetail.getQuantite());
            prepare.setInt(2, unDetail.getUneCommande().getRefCommandes());
            prepare.setInt(3, unDetail.getUnMedicament().getIdMedoc());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static boolean modifierDemande(Demande uneDemande) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "UPDATE demandes SET id_employe=?, date=? WHERE id_demande=?";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, uneDemande.getUnEmploye().getIdEmploye());
            prepare.setString(2, uneDemande.getDate());
            prepare.setInt(3, uneDemande.getIdDemande());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static boolean modifierDetailsDemandes(DetailsDemande unDetail) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "UPDATE detail_demandes SET qt=? WHERE id_demande=? AND id_medoc=?";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, unDetail.getQuantite());
            prepare.setInt(2, unDetail.getUneDemande().getIdDemande());
            prepare.setInt(3, unDetail.getUnMedicament().getIdMedoc());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static ArrayList<Medicament> donneLeStock() {
        ArrayList<Medicament> lesMedocs = new ArrayList<Medicament>();
        if (pdo == null) {
            connectionPDO();
        }
        try {
            Statement state = pdo.createStatement();
            String requete = "SELECT * FROM medicaments Order by id_medoc";
            ResultSet jeuResultat = state.executeQuery(requete);
            while (jeuResultat.next()) {
                int idMedoc = jeuResultat.getInt(1);
                String libelle = jeuResultat.getString(2);
                String description = jeuResultat.getString(3);
                int nbStocks = jeuResultat.getInt(4);
                String localisation = jeuResultat.getString(5);
                Medicament unMedicament = new Medicament(idMedoc, libelle, description, nbStocks, localisation);
                lesMedocs.add(unMedicament);
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return lesMedocs;
    }

    public static boolean ajoutFournisseur(Fournisseur unFournisseur){
        boolean bool = false;
        if(pdo==null){
            connectionPDO();
        }
        try{
            String requete = "insert into fournisseur (nom,rue,cp,ville,telephone) values (?,?,?,?,?)";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setString(1,unFournisseur.getNom());
            prepare.setString(2,unFournisseur.getRue());
            prepare.setString(3,unFournisseur.getCp());
            prepare.setString(4,unFournisseur.getVille());
            prepare.setString(5,unFournisseur.getTel());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    public static Boolean modifierStock(Medicament unMedicament) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        try {
            Statement state = pdo.createStatement();
            String requete = "UPDATE medicaments SET libelle=?,description=?,stock=?,localisation=? WHERE id_medoc=?";
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setString(1, unMedicament.getLibelle());
            prepare.setString(2, unMedicament.getDescription());
            prepare.setInt(3, unMedicament.getNbStocks());
            prepare.setString(4, unMedicament.getLocalisation());
            prepare.setInt(5, unMedicament.getIdMedoc());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }

    public static Medicament donneUnMedicament(int id) {
        if (pdo == null) {
            connectionPDO();
        }
        Medicament unMedicament = null;
        try {
            state = pdo.createStatement();
            String requete = ("select * from medicaments where id_medoc=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, id);
            res = prepare.executeQuery();
            res.next();
            unMedicament = new Medicament(res.getInt(1), res.getString(2), res.getString(3), res.getInt(4), res.getString(5));
            return unMedicament;
        } catch (Exception e) {
            System.out.println(e);
            System.out.println("Erreur connexion!");
        }
        return unMedicament;
    }

    public static boolean validerDemande(Demande uneDemande) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        if (uneDemande.getValide() != 2) {
            try {
                state = pdo.createStatement();
                String requete =("UPDATE demandes SET valide=1 WHERE id_demande=?");
                PreparedStatement prepare = pdo.prepareStatement(requete);
                prepare.setInt(1, uneDemande.getIdDemande());
                prepare.executeUpdate();
                bool = true;
            } catch (Exception e) {
                System.out.println(e);
            }
        }
        return bool;
    }

    public static boolean refuserDemande(Demande uneDemande) {
        if (pdo == null) {
            connectionPDO();
        }
        boolean bool = false;
        if (uneDemande.getValide() != 1) {
            try {
                state = pdo.createStatement();
                String requete=("UPDATE demandes SET valide=2 WHERE id_demande=?");
                PreparedStatement prepare = pdo.prepareStatement(requete);
                prepare.setInt(1, uneDemande.getIdDemande());
                prepare.executeUpdate();
                bool = true;
            } catch (Exception e) {
                System.out.println(e);
            }
        }
        return bool;
    }
    
    public static boolean verifIdCommande(int idCommande){
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            state=pdo.createStatement();
            String requete = ("select * from commandes where id_commande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1,idCommande);
            res = prepare.executeQuery();
            res.next();
            if(res.getRow()==0){
                bool=true;
            }
        }           
        catch(Exception e){
        
        }
        return bool;
    }
    
    public static boolean verifIdDemande(int idDemande){
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            state=pdo.createStatement();
            String requete = ("select * from demandes where id_demande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1,idDemande);
            res = prepare.executeQuery();
            res.next();
            if(res.getRow()==0){
                bool=true;
            }
        }
        catch(Exception e){
            
        }
        return bool;
    }
    
    public static boolean verifMedocCommande(int idmedoc){
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            state=pdo.createStatement();
            String requete = ("select * from detail_commandes where id_medoc=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1,idmedoc);
            res = prepare.executeQuery();
            res.next();
            if(res.getRow()==0){
                bool=true;
            }
        }
        catch(Exception e){
            
        }
        return bool;
    }
    
    public static boolean verifMedocDemande(int idmedoc){
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            state=pdo.createStatement();
            String requete = ("select * from detail_demandes where id_medoc=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1,idmedoc);
            res = prepare.executeQuery();
            res.next();
            if(res.getRow()==0){
                bool=true;
            }
        }
        catch(Exception e){
            
        }
        return bool;
    }
    
    public static int getIdMaxCommande(){
        if(pdo==null){
            connectionPDO();
        }
        int unIdMax = 0;
        try {
            Statement state = pdo.createStatement();
            String requete = "SELECT MAX(id_commande)+1 FROM commandes";
            ResultSet jeuResultat = state.executeQuery(requete);
            while (jeuResultat.next()) {
                unIdMax = jeuResultat.getInt(1);
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return unIdMax;
    }
    
    public static int getIdMaxDemande(){
        if(pdo==null){
            connectionPDO();
        }
        int unIdMax = 0;
        try {
            Statement state = pdo.createStatement();
            String requete = "SELECT MAX(id_demande)+1 FROM demandes";
            ResultSet jeuResultat = state.executeQuery(requete);
            while (jeuResultat.next()) {
                unIdMax = jeuResultat.getInt(1);
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return unIdMax;
    }
    
    public static Integer donneQuantiteMedicamentCommande(int id) {
        if (pdo == null) {
            connectionPDO();
        }
        Integer retour = null;
        try {
            state = pdo.createStatement();
            String requete = ("select qt from detail_commandes where id_commande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, id);
            res = prepare.executeQuery();
            res.next();
            retour = res.getInt(1);
        } catch (Exception e) {
            System.out.println(e);
            System.out.println("Erreur connexion!");
        }
        return retour;
    }
    
    public static Integer donneQuantiteMedicamentDemande(int id) {
        if (pdo == null) {
            connectionPDO();
        }
        Integer retour = null;
        try {
            state = pdo.createStatement();
            String requete = ("select qt from detail_demandes where id_demande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, id);
            res = prepare.executeQuery();
            res.next();
            retour = res.getInt(1);
        } catch (Exception e) {
            System.out.println(e);
            System.out.println("Erreur connexion!");
        }
        return retour;
    }
    
    public static String getMedocsDemandeParId(int id_demande){
        if(pdo==null){
            connectionPDO();
        }
        String lesLibelles="";
        String libelle="";
        try {
            state = pdo.createStatement();
            String requete=("select libelle from medicaments join detail_demandes on medicaments.id_medoc=detail_demandes.id_medoc where id_demande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, id_demande);
            res = prepare.executeQuery();
            while(res.next()){
                libelle=res.getString(1);
                lesLibelles=lesLibelles+" "+libelle;
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        if(lesLibelles=="null"){
            lesLibelles="";
        }
        return lesLibelles;
    }
    
    public static String getMedocsCommandeParId(int id_commande){
        if(pdo==null){
            connectionPDO();
        }
        String lesLibelles="";
        String libelle="";
        try {
            state = pdo.createStatement();
            String requete=("select libelle from medicaments join detail_commandes on medicaments.id_medoc=detail_commandes.id_medoc where id_commande=?");
            PreparedStatement prepare = pdo.prepareStatement(requete);
            prepare.setInt(1, id_commande);
            res = prepare.executeQuery();
            while(res.next()){
                libelle=res.getString(1);
                lesLibelles=lesLibelles+" "+libelle;
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        if(lesLibelles=="null"){
            lesLibelles="";
        }
        return lesLibelles;
    }
}
