package com.example.jacletgestionrendezvous;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.json.JSONStringer;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class ecran_patient extends AppCompatActivity {

    public class TacheAsync extends AsyncTask<Object, Integer, String> {
        private String methode;
        @Override
        protected String doInBackground(Object... arg){
            String res ="";
            URL url;
            StringBuffer leBuffer = new StringBuffer(res);
            methode = arg[0].toString();
            Log.i("oe",methode);
            switch(methode) {
                case "GET":
                    try {
                        url = new URL("http://192.168.1.69:8000/api/consultations?page=1");
                        HttpURLConnection connexion = (HttpURLConnection) url.openConnection();
                        connexion.setRequestMethod("GET");
                        InputStream leFluxEntree = new BufferedInputStream(connexion.getInputStream());
                        BufferedReader leLecteur = new BufferedReader(new InputStreamReader(leFluxEntree));
                        String laLigne = leLecteur.readLine();
                        while (laLigne != null) {
                            leBuffer.append(laLigne);
                            leBuffer.append("\n");
                            laLigne = leLecteur.readLine();
                        }
                        res = leBuffer.toString();
                        JSONObject Consultations = new JSONObject(res);
                        res = Consultations.getString("hydra:member");
                    } catch (Exception e) {
                        res = "erreur **********";
                    }
                    Log.i("oe",res.toString());
                    break;
                case "PUT":
                    try {
                        //object url et objet httpUrlConnection
                        Consultation uneConsultation = (Consultation) arg[1];
                        url = new URL("http://192.168.1.69:8000"+uneConsultation.getId());
                        HttpURLConnection conn = (HttpURLConnection) url.openConnection();


                        //methode et entrées/sorties
                        conn.setRequestMethod("PUT");
                        conn.setDoInput(true);
                        conn.setDoOutput(true);
                        conn.setRequestProperty("Content-Type","application/json; charset=UTF-8");

                        OutputStream outputPost = conn.getOutputStream();
                        BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(outputPost, "UTF-8"));

                        String query = new JSONStringer()
                                .object()
                                .key("motif").value(uneConsultation.getMotif())
                                .key("etat").value("Annulee")
                                .key("duree").value(uneConsultation.getDuree())
                                .key("medecin").value(uneConsultation.getMedecin())
                                .key("patient").value(uneConsultation.getPatient())
                                .endObject()
                                .toString();

                        Log.i("oe",query);

                        writer.write(query);
                        writer.flush();
                        writer.close();
                        outputPost.close();
                        conn.connect();

                        //traitement réponse
                        int codeResponse = conn.getResponseCode();
                        if (codeResponse == HttpURLConnection.HTTP_OK) {
                            InputStream leFluxEntree = new BufferedInputStream(conn.getInputStream());
                            BufferedReader leLecteur = new BufferedReader(new InputStreamReader(leFluxEntree));
                            String laLigne = leLecteur.readLine();
                            while (laLigne != null) {
                                leBuffer.append(laLigne);
                                leBuffer.append("\n");
                                laLigne = leLecteur.readLine();
                            }
                            res = leBuffer.toString();
                        } else {
                            res = "Erreur réponse *******";
                            Log.i("oe",String.valueOf(codeResponse)+" - "+conn.getResponseMessage());
                        }
                    }
                    catch (Exception e) {
                        e.printStackTrace();
                        res = "Erreur **********";
                    }
                    break;
            }
            return res;
        }

        @Override
        protected void onPostExecute(String res) {
            super.onPostExecute(res);
            switch (methode) {
                case "GET":
                    ArrayList<Consultation> lesConsultations = new ArrayList<Consultation>();
                    Consultation laConsultation = null;
                    JSONObject lObject = null;
                    JSONArray tous = null;
                    try {
                        tous = new JSONArray(res);
                        for (int i = 0; i < tous.length(); i++) {
                            lObject = tous.getJSONObject(i);
                            laConsultation = new Consultation(lObject.getString("@id"), lObject.getString("dateHeure"), lObject.getString("motif"),
                                    lObject.getString("etat"), lObject.getString("duree"), lObject.getString("medecin"), lObject.getString("patient"));
                            lesConsultations.add(laConsultation);
                            Log.i("oe",laConsultation.toString());
                        }
                    } catch (JSONException e) {
                        Log.i("oe","erreur");
                        Log.i("oe",e.toString());
                    }
                    ArrayAdapter<Consultation> dataAdapter = new ArrayAdapter<Consultation>(ecran_patient.this, android.R.layout.simple_list_item_single_choice, lesConsultations);
                    Spinner affichage = (Spinner) findViewById(R.id.spinRDV);
                    affichage.setAdapter(dataAdapter);
                    break;
                case "PUT":

            }
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ecran_patient);
        TacheAsync maTache = new TacheAsync();
        maTache.execute("GET");

        Spinner leSpinner = (Spinner) findViewById(R.id.spinRDV);

        Button btnDetail = findViewById(R.id.btn_afficher_un_rdv);
        btnDetail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Consultation laConsultation = (Consultation) leSpinner.getSelectedItem();
                Intent detailsConsultation = new Intent(ecran_patient.this, detailConsultation.class);
                detailsConsultation.putExtra("id", laConsultation.getId());
                startActivity(detailsConsultation);
            }
        });

        Button btnAnnule = findViewById(R.id.btn_annuler_un_rdv);
        btnAnnule.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Consultation uneConsultation = (Consultation) leSpinner.getSelectedItem();
                TacheAsync androidStudioEstIllogique = new TacheAsync();
                androidStudioEstIllogique.execute("PUT",uneConsultation);
            }
        });

        Button btnChanger=findViewById(R.id.btn_demande_rdv);
        btnChanger.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent mainActivity2=new Intent(ecran_patient.this, demande_rdv.class);
                startActivity(mainActivity2);
            }
        });
    }
}