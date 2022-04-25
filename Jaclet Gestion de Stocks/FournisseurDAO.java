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
public class FournisseurDAO extends DAO<Fournisseur>{

    @Override
    public ArrayList<String> donnerTout() {
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

    @Override
    public boolean ajouter(Fournisseur unFournisseur) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="INSERT INTO fournisseur VALUES(?, ?, ?, ?, ?, ?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unFournisseur.getIdFournisseur());
            prepare.setString(2,unFournisseur.getNom());
            prepare.setString(3,unFournisseur.getRue());
            prepare.setString(4,unFournisseur.getCp());
            prepare.setString(5,unFournisseur.getVille());
            prepare.setString(6,unFournisseur.getTel());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(Fournisseur unFournisseur) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            String requete="UPDATE fournisseur SET nom=?, rue=?, cp=?, ville=?, telephone=? WHERE id_fournisseur=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setString(1,unFournisseur.getNom());
            prepare.setString(2,unFournisseur.getRue());
            prepare.setString(3,unFournisseur.getCp());
            prepare.setString(4,unFournisseur.getVille());
            prepare.setString(5,unFournisseur.getTel());
            prepare.setInt(6,unFournisseur.getIdFournisseur());
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(Fournisseur unFournisseur) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM fournisseur WHERE id_fournisseur=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,unFournisseur.getIdFournisseur());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
}
