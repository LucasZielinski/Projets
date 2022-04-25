/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package pharmacie;

import java.util.ArrayList;

/**
 *
 * @author sio2021
 */
public class ModifierStock extends javax.swing.JFrame {

    /**
     * Creates new form ModifierStock
     */
    public ModifierStock(Medicament unMedicament) {
        initComponents();
        lblIdMedoc.setText(String.valueOf(unMedicament.getIdMedoc()));
        txtLibelle.setText(unMedicament.getLibelle());
        txtDescription.setText(unMedicament.getDescription());
        txtStock.setText(String.valueOf(unMedicament.getNbStocks()));
        txtLocalisation.setText(unMedicament.getLocalisation());
    }
    
    public ModifierStock(){
        initComponents();
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jLabel3 = new javax.swing.JLabel();
        lblModif = new javax.swing.JLabel();
        lblId = new javax.swing.JLabel();
        lblLibelle = new javax.swing.JLabel();
        txtLibelle = new javax.swing.JTextField();
        jLabel1 = new javax.swing.JLabel();
        jScrollPane1 = new javax.swing.JScrollPane();
        txtDescription = new javax.swing.JTextArea();
        jLabel2 = new javax.swing.JLabel();
        txtStock = new javax.swing.JTextField();
        lblLocalisation = new javax.swing.JLabel();
        txtLocalisation = new javax.swing.JTextField();
        btnValider = new javax.swing.JButton();
        lblIdMedoc = new javax.swing.JLabel();
        lblInfo = new javax.swing.JLabel();
        btnRetour = new javax.swing.JButton();

        jLabel3.setText("jLabel3");

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        lblModif.setText("Modifier stock");

        lblId.setText("Id:");

        lblLibelle.setText("Libelle:");

        txtLibelle.setText("jTextField1");

        jLabel1.setText("Description:");

        txtDescription.setColumns(20);
        txtDescription.setRows(5);
        jScrollPane1.setViewportView(txtDescription);

        jLabel2.setText("Stock:");

        txtStock.setText("jTextField1");

        lblLocalisation.setText("Localisation:");

        txtLocalisation.setText("jTextField1");

        btnValider.setText("Valider");
        btnValider.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                btnValiderMouseClicked(evt);
            }
        });

        lblIdMedoc.setText("jLabel4");

        btnRetour.setText("Retour");
        btnRetour.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                btnRetourMouseClicked(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGap(84, 84, 84)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addComponent(lblLocalisation)
                    .addComponent(jLabel2)
                    .addComponent(jLabel1))
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jScrollPane1, javax.swing.GroupLayout.DEFAULT_SIZE, 295, Short.MAX_VALUE)
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addComponent(btnValider, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                            .addComponent(txtLocalisation)
                            .addComponent(txtStock))
                        .addGap(0, 0, Short.MAX_VALUE))
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(lblInfo)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(btnRetour)))
                .addContainerGap())
            .addGroup(layout.createSequentialGroup()
                .addGap(111, 111, 111)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(lblLibelle)
                        .addGap(18, 18, 18)
                        .addComponent(txtLibelle, javax.swing.GroupLayout.PREFERRED_SIZE, 65, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(lblId)
                        .addGap(18, 18, 18)
                        .addComponent(lblIdMedoc)
                        .addGap(31, 31, 31))
                    .addComponent(lblModif))
                .addGap(203, 203, 203))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(lblModif)
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(lblId)
                    .addComponent(lblIdMedoc))
                .addGap(18, 18, 18)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(lblLibelle)
                    .addComponent(txtLibelle, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(33, 33, 33)
                        .addComponent(jLabel1))
                    .addGroup(layout.createSequentialGroup()
                        .addGap(18, 18, 18)
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 76, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel2)
                            .addComponent(txtStock, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(26, 26, 26)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(lblLocalisation)
                            .addComponent(txtLocalisation, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                        .addGap(32, 32, 32)
                        .addComponent(btnValider)
                        .addGap(18, 18, 18)
                        .addComponent(lblInfo)
                        .addContainerGap(50, Short.MAX_VALUE))
                    .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(btnRetour)
                        .addContainerGap())))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void btnValiderMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_btnValiderMouseClicked
        Integer idMedoc = Integer.parseInt(lblIdMedoc.getText()),stock=null;
        String libelle = txtLibelle.getText(),description = txtDescription.getText(),localisation = txtLocalisation.getText();
        String champ,champNom,info="";
        ArrayList<String> lesChamps = new ArrayList<String>();
        ArrayList<Integer> lesLongueurs = new ArrayList<Integer>();
        ArrayList<String> lesNomChamps = new ArrayList<String>();
        lesChamps.add(libelle);
        lesChamps.add(description);
        lesChamps.add(localisation);
        lesLongueurs.add(40);
        lesLongueurs.add(200);
        lesLongueurs.add(40);
        lesNomChamps.add("libelle");
        lesNomChamps.add("description");
        lesNomChamps.add("localisation");
        Boolean bool = true;
        int i=0;
        while(bool && i<lesChamps.size()){
            champ=lesChamps.get(i);
            champNom=lesNomChamps.get(i);
            if(champ.isEmpty()){
                bool=false;
                info="Le champ "+champNom+" ne peut pas être vide";
            }
            else{
                if(champ.length()>lesLongueurs.get(i)){
                    bool=false;
                    info="Le champ "+champNom+" est trop long pour la base de donnée";
                }
            }
            i++;
        }
        if(!bool){
            lblInfo.setText(info);
        }
        else{
            try{
                stock = Integer.parseInt(txtStock.getText());
            }
            catch(Exception e){
                bool=false;
                info="Le champ stock doit être un nombre";
                lblInfo.setText(info);
            }
        }
        if(bool){
            Medicament modifMedicament = new Medicament(idMedoc,libelle,description,stock,localisation);
            boolean fonctionne = Passerelle.modifierStock(modifMedicament);
            if(fonctionne){
                this.dispose();
            }
            else{
                lblInfo.setText("Erreur lors de la modification");
            }
        }
    }//GEN-LAST:event_btnValiderMouseClicked

    private void btnRetourMouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_btnRetourMouseClicked
        // TODO add your handling code here:
        this.dispose();
    }//GEN-LAST:event_btnRetourMouseClicked

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(ModifierStock.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(ModifierStock.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(ModifierStock.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(ModifierStock.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new ModifierStock().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnRetour;
    private javax.swing.JButton btnValider;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JLabel lblId;
    private javax.swing.JLabel lblIdMedoc;
    private javax.swing.JLabel lblInfo;
    private javax.swing.JLabel lblLibelle;
    private javax.swing.JLabel lblLocalisation;
    private javax.swing.JLabel lblModif;
    private javax.swing.JTextArea txtDescription;
    private javax.swing.JTextField txtLibelle;
    private javax.swing.JTextField txtLocalisation;
    private javax.swing.JTextField txtStock;
    // End of variables declaration//GEN-END:variables
}