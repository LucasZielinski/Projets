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
public class CommandeDAO extends DAO<Commande>{
    
    @Override
    public ArrayList<String> donnerTout(){
        if(pdo==null){
            connectionPDO();
        }
        Commande uneCommande = null;
        ArrayList<String> lesCommandes=new ArrayList<String>();
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
                lesCommandes.add(uneCommande.toString());
            }  
        }
        catch(Exception e){
            System.out.println(e);
        }
        return lesCommandes;
    }

    @Override
    public boolean ajouter(Commande uneCommande) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            Statement state=pdo.createStatement();
            int idcommande=uneCommande.getRefCommandes();
            int idfournisseur=uneCommande.getUnFournisseur().getIdFournisseur();
            String date=uneCommande.getDate();
            int idemploye=uneCommande.getUnEmploye().getIdEmploye();
            String requete="INSERT INTO commandes VALUES(?, ?, ?, ?)";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,idcommande);
            prepare.setInt(2,idfournisseur);
            prepare.setString(3,date);
            prepare.setInt(4,idemploye);
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean modifier(Commande uneCommande) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool=false;
        try{
            Statement state=pdo.createStatement();
            int idcommande=uneCommande.getRefCommandes();
            int idfournisseur=uneCommande.getUnFournisseur().getIdFournisseur();
            String date=uneCommande.getDate();
            int idemploye=uneCommande.getUnEmploye().getIdEmploye();
            String requete="UPDATE commandes SET id_fournisseur=?, date=?, id_employe=? WHERE id_commande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,idfournisseur);
            prepare.setString(2,date);
            prepare.setInt(3,idemploye);
            prepare.setInt(4,idcommande);
            prepare.executeUpdate();
            bool=true;
         }
        catch(Exception e){
            System.out.println(e);
        }
        return bool;
    }

    @Override
    public boolean supprimer(Commande uneCommande) {
        if(pdo==null){
            connectionPDO();
        }
        boolean bool = false;
        try {
            String requete = "DELETE FROM commandes WHERE id_commande=?";
            PreparedStatement prepare=pdo.prepareStatement(requete);
            prepare.setInt(1,uneCommande.getRefCommandes());
            prepare.executeUpdate();
            bool = true;
        } catch (Exception e) {
            System.out.println(e);
        }
        return bool;
    }
}
