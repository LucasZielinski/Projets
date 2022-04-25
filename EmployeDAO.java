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
public class EmployeDAO extends DAO<Employe>{
    
    @Override
    public ArrayList<String> donnerTout(){
        if(pdo==null){
            connectionPDO();
        }
        Employe uneEmploye = null;
        ArrayList<String> lesEmployes=new ArrayList<String>();
        try{
            Statement state=pdo.createStatement();
            String requete = "SELECT * FROM employes";
            ResultSet jeuResultat=state.executeQuery(requete);
            while(jeuResultat.next()){
                int id=jeuResultat.getInt(1);
                String nom=jeuResultat.getString(2);
                String prenom=jeuResultat.getString(3);
                int age=jeuResultat.getInt(4);
                String login=jeuResultat.getString(5);
                String mdp=jeuResultat.getString(6);
                int idService=jeuResultat.getInt(7);
                String role=jeuResultat.getString(8);
                Employe unEmploye=new Employe(id,nom,prenom,age,login,mdp,idService,role);
                lesEmployes.add(uneEmploye.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesEmployes;
    }

    @Override
    public boolean ajouter(Employe unEmploye) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="INSERT INTO employes VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unEmploye.getIdEmploye());
            prepare.setString(2,unEmploye.getNom());
            prepare.setString(3,unEmploye.getPrenom());
            prepare.setInt(4,unEmploye.getAge());
            prepare.setString(5,unEmploye.getLogin());
            prepare.setString(6,unEmploye.getMdp());
            prepare.setInt(7,unEmploye.getIdService());
            prepare.setString(8,unEmploye.getRole());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(Employe unEmploye) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="UPDATE employes SET nom=?, prenom=?, age=?, login=?, mdp=?, id_service=?, role=? WHERE id_employe=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setString(1,unEmploye.getNom());
            prepare.setString(2,unEmploye.getPrenom());
            prepare.setInt(3,unEmploye.getAge());
            prepare.setString(4,unEmploye.getLogin());
            prepare.setString(5,unEmploye.getMdp());
            prepare.setInt(6,unEmploye.getIdService());
            prepare.setString(7,unEmploye.getRole());
            prepare.setInt(8,unEmploye.getIdEmploye());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(Employe unEmploye) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM employes WHERE id_employe=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unEmploye.getIdEmploye());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
}
