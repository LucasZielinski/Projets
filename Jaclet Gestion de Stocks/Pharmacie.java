/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

/**
 *
 * @author sio2
 */
public class Pharmacie {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args){
	String hash1 = Password.hashPassword("Jaclet");
        System.out.println(hash1);
        String hash2 = Password.hashPassword("Dubois");
        System.out.println(hash2);
        String hash3 = Password.hashPassword("Jean");
        System.out.println(hash3);
    }
}
