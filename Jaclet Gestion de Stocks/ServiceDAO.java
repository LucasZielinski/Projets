/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import static pharmacie.DAO.pdo;

/**
 *
 * @author sio2021
 */
public class ServiceDAO extends DAO<Service>{

    @Override
    public ArrayList<String> donnerTout() {
        if(pdo==null){
            connectionPDO();
        }
        Service unService = null;
        ArrayList<String> lesServices=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM services";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int id=jeuResultat.getInt(1);
                String libelle=jeuResultat.getString(2);
                unService=new Service(id,libelle);
                lesServices.add(unService.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesServices;
    }

    @Override
    public boolean ajouter(Service unService) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="INSERT INTO services VALUES(?, ?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unService.getIdService());
            prepare.setString(2,unService.getLibelle());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(Service unService) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="UPDATE services SET libelle=? WHERE id_service=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setString(1,unService.getLibelle());
            prepare.setInt(2,unService.getIdService());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(Service unService) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM services WHERE id_service=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unService.getIdService());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
    
}
