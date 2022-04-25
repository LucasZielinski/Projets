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
import static pharmacie.DAO.pdo;
import static pharmacie.Passerelle.connectionPDO;

/**
 *
 * @author sio2021
 */
public class DetailsDemandeDAO extends DAO<DetailsDemande>{

    @Override
    public ArrayList<String> donnerTout() {
        if(pdo==null){
            connectionPDO();
        }
        DetailsDemande unDetail = null;
        ArrayList<String> lesDetails=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM detail_demandes";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int idDemande=jeuResultat.getInt(1);
                int idMedoc=jeuResultat.getInt(2);
                int qt=jeuResultat.getInt(3);
                Demande uneDemande=new Demande(idDemande,null,null,0);
                Medicament unMedoc=new Medicament(idMedoc,null,null,0,null);
                unDetail=new DetailsDemande(uneDemande,unMedoc,qt);
                lesDetails.add(unDetail.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesDetails;
    }

    @Override
    public boolean ajouter(DetailsDemande unDetail) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            Statement state=pdo.createStatement();
            int iddemande=unDetail.getUneDemande().getIdDemande();
            int idmedoc=unDetail.getUnMedicament().getIdMedoc();
            int qt=unDetail.getQuantite();
            String requete="INSERT INTO detail_demandes VALUES(?, ?, ?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,iddemande);
            prepare.setInt(2,idmedoc);
            prepare.setInt(3,qt);
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(DetailsDemande unDetail) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            Statement state=pdo.createStatement();
            int iddemande=unDetail.getUneDemande().getIdDemande();
            int idmedoc=unDetail.getUnMedicament().getIdMedoc();
            int qt=unDetail.getQuantite();
            String requete="UPDATE detail_demandes SET id_medoc=?, qt=? WHERE id_demande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,idmedoc);
            prepare.setInt(2,qt);
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
    public boolean supprimer(DetailsDemande unDetail) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM detail_demandes WHERE id_demande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unDetail.getUneDemande().getIdDemande());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
    
}
