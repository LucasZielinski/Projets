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
import static pharmacie.Passerelle.connectionPDO;

/**
 *
 * @author sio2021
 */
public class DemandeDAO extends DAO<Demande>{

    @Override
    public ArrayList<String> donnerTout() {
        if(pdo==null){
            connectionPDO();
        }
        Demande uneDemande = null;
        ArrayList<String> lesDemandes = new ArrayList<String>();
        try {
            Statement state = pdo.createStatement();
            String requete = "SELECT * FROM demandes";
            ResultSet jeuResultat = state.executeQuery(requete);
            while (jeuResultat.next()) {
                int idDemande = jeuResultat.getInt(1);
                int idEmploye = jeuResultat.getInt(2);
                String date = jeuResultat.getString(3);
                Employe unEmploye = new Employe(idEmploye, null, null, 0, null, null, 0, null);
                uneDemande = new Demande(idDemande, unEmploye, date, 0);
                lesDemandes.add(uneDemande.toString());
            }
        } catch (Exception e) {
            System.out.println(e);
        }
        return lesDemandes;
    }

    @Override
    public boolean ajouter(Demande uneDemande) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            int iddemande=uneDemande.getIdDemande();
            int idemploye=uneDemande.getUnEmploye().getIdEmploye();
            String date=uneDemande.getDate();
            String requete="INSERT INTO demandes VALUES(?, ?, ?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,iddemande);
            prepare.setInt(2,idemploye);
            prepare.setString(3,date);
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(Demande uneDemande) {
        boolean bool=false;
        try{
            int iddemande=uneDemande.getIdDemande();
            int idemploye=uneDemande.getUnEmploye().getIdEmploye();
            String date=uneDemande.getDate();
            String requete="UPDATE demandes SET id_employe=?, date=? WHERE id_demande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,idemploye);
            prepare.setString(2,date);
            prepare.setInt(3,iddemande);
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(Demande uneDemande) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM demandes WHERE id_demande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,uneDemande.getIdDemande());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
    
}
