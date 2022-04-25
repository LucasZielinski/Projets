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
public class DetailsCommandesDAO extends DAO<DetailsCommandes>{

    @Override
    public ArrayList<String> donnerTout() {
        if(pdo==null){
            connectionPDO();
        }
        DetailsCommandes unDetail = null;
        ArrayList<String> lesDetails=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM detail_commandes";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int idCommande=jeuResultat.getInt(1);
                int idMedoc=jeuResultat.getInt(2);
                int qt=jeuResultat.getInt(3);
                Commande uneCommande=new Commande(idCommande,null,null,null);
                Medicament unMedoc=new Medicament(idMedoc,null,null,0,null);
                unDetail=new DetailsCommandes(uneCommande,unMedoc,qt);
                lesDetails.add(unDetail.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesDetails;
    }

    @Override
    public boolean ajouter(DetailsCommandes unDetail) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            Statement state=pdo.createStatement();
            int idcommande=unDetail.getUneCommande().getRefCommandes();
            int idmedicament=unDetail.getUnMedicament().getIdMedoc();
            int qt=unDetail.getQuantite();
            String requete="INSERT INTO detail_commandes VALUES(?,?,?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,idcommande);
            prepare.setInt(2,idmedicament);
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
    public boolean modifier(DetailsCommandes unDetail) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            Statement state=pdo.createStatement();
            int idcommande=unDetail.getUneCommande().getRefCommandes();
            int idmedicament=unDetail.getUnMedicament().getIdMedoc();
            int qt=unDetail.getQuantite();
            String requete="UPDATE detail_commandes SET id_medoc=?, qt=? WHERE id_commande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,idmedicament);
            prepare.setInt(2,qt);
            prepare.setInt(3,idcommande);
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(DetailsCommandes unDetail) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM detail_commandes WHERE id_commande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unDetail.getUneCommande().getRefCommandes());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
    
}
