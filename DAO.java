/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

/**
 *
 * @author sio2021
 */
public abstract class DAO<T>{
    protected static Connection pdo;
    
    public static void connectionPDO(){
        try{
            pdo = DriverManager.getConnection("jdbc:postgresql://192.168.1.245:5432/slam2022_daopharmacie_guichard","guichard","guichard");
        }
        catch(Exception e){
            System.out.println(e);
            System.out.println("Erreur!");
        }
    }
    
    public abstract ArrayList<String> donnerTout();
    
    public abstract boolean ajouter(T unObjet);
    
    public abstract boolean modifier(T unObjet);
    
    public abstract boolean supprimer(T unObjet);
}
