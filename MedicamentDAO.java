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
public class MedicamentDAO extends DAO<Medicament>{

    @Override
    public ArrayList<String> donnerTout() {
        if(pdo==null){
            connectionPDO();
        }
        Medicament unMedoc = null;
        ArrayList<String> lesMedocs=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM medicaments";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int id=jeuResultat.getInt(1);
                String libelle=jeuResultat.getString(2);
                String desc=jeuResultat.getString(3);
                int nbStocks=jeuResultat.getInt(4);
                String localisation=jeuResultat.getString(5);
                unMedoc=new Medicament(id,libelle,desc,nbStocks,localisation);
                lesMedocs.add(unMedoc.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesMedocs;
    }

    @Override
    public boolean ajouter(Medicament unMedoc) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="INSERT INTO medicaments VALUES(?, ?, ?, ?,?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unMedoc.getIdMedoc());
            prepare.setString(2,unMedoc.getLibelle());
            prepare.setString(3,unMedoc.getDescription());
            prepare.setInt(4,unMedoc.getNbStocks());
            prepare.setString(5,unMedoc.getLocalisation());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(Medicament unMedoc) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="UPDATE medicaments SET libelle=?, description=?, stock=?, localisation=? WHERE id_medoc=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setString(1,unMedoc.getLibelle());
            prepare.setString(2,unMedoc.getDescription());
            prepare.setInt(3,unMedoc.getNbStocks());
            prepare.setString(4,unMedoc.getLocalisation());
            prepare.setInt(5,unMedoc.getIdMedoc());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(Medicament unMedoc) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM medicaments WHERE id_medoc=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unMedoc.getIdMedoc());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
    
}
