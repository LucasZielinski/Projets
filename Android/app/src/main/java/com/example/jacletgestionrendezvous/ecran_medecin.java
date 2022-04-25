package com.example.jacletgestionrendezvous;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class ecran_medecin extends AppCompatActivity {

    public class TacheAsync extends AsyncTask<String, Integer, String> {

        @Override
        protected String doInBackground(String... arg){
            String res ="";
            URL url;
            StringBuffer leBuffer = new StringBuffer(res);
            try{
                url = new URL("http://192.168.1.69:8000/api/consultations?page=1");
                HttpURLConnection connexion = (HttpURLConnection) url.openConnection();
                connexion.setRequestMethod("GET");
                InputStream leFluxEntree = new BufferedInputStream(connexion.getInputStream());
                BufferedReader leLecteur = new BufferedReader(new InputStreamReader(leFluxEntree));
                String laLigne = leLecteur.readLine();
                while(laLigne != null){
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
            return res;
        }

        @Override
        protected void onPostExecute(String res){
            super.onPostExecute(res);
            ArrayList<Consultation> lesConsultations = new ArrayList<Consultation>();
            Consultation laConsultation = null;
            JSONObject lObject = null;
            JSONArray tous = null;
            try {
                tous = new JSONArray(res);
                for (int i = 0; i < tous.length(); i++) {
                    lObject = tous.getJSONObject(i);
                    laConsultation = new Consultation(lObject.getString("@id"), lObject.getString("date_heure"), lObject.getString("motif"),
                            lObject.getString("etat"), lObject.getString("duree"), lObject.getString("medecin"), lObject.getString("patient"));
                    lesConsultations.add(laConsultation);
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
            ArrayAdapter<Consultation> dataAdapter = new ArrayAdapter<Consultation>(ecran_medecin.this, android.R.layout.simple_list_item_single_choice, lesConsultations);
            Spinner affichage = (Spinner) findViewById(R.id.spinRDV);
            affichage.setAdapter(dataAdapter);
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ecran_medecin);
        ecran_medecin.TacheAsync maTache = new ecran_medecin.TacheAsync();
        maTache.execute();

        Spinner leSpinner = (Spinner) findViewById(R.id.spinRDV);

        Button btnDetail = findViewById(R.id.btn_afficher_un_rdv);


        btnDetail.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Consultation laConsultation = (Consultation) leSpinner.getSelectedItem();
                Intent detailsConsultation = new Intent(ecran_medecin.this, detailConsultation.class);
                detailsConsultation.putExtra("id", laConsultation.getId());
                startActivity(detailsConsultation);
            }
        });
    }
}
