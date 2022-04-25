package com.example.jacletgestionrendezvous;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;

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
import java.util.concurrent.TimeUnit;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class detailConsultation extends AppCompatActivity {
    private String medecinId;

    public class TacheAsync extends AsyncTask<String, Integer, String> {
        private String methode;
        @Override
        protected String doInBackground(String... arg){
            String res = "";
            URL url;
            StringBuffer leBuffer = new StringBuffer(res);
            methode = arg[1];
            switch(methode) {
                case "GET":
                    try {
                        url = new URL("http://192.168.1.69:8000" + arg[0]);
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
                        JSONObject lObject = new JSONObject(res);
                        Pattern p;
                        Matcher m;
                        p = Pattern.compile("\\d+");
                        medecinId = lObject.getString("medecin");
                        m = p.matcher(medecinId);
                        if(m.find()) {
                            medecinId = m.group();
                        }
                    } catch (Exception e) {
                        e.printStackTrace();
                        res = "erreur **********";
                    }
                    break;
                case "medecin":
                    try {
                    url = new URL("http://192.168.1.69:8000/api/utilisateurs/" + medecinId);
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
                } catch (Exception e) {
                    e.printStackTrace();
                    res = "erreur **********";
                }
                break;
            }
            return res;
        }

        @Override
        protected void onPostExecute(String res) {
            super.onPostExecute(res);

            TextView txt_date_rdv = (TextView) findViewById(R.id.txt_date_rdv);
            TextView txt_heure_rdv = (TextView) findViewById(R.id.txt_heure_rdv);
            TextView txt_precisions = (TextView) findViewById(R.id.txt_precisions);
            switch (methode) {
                case "GET":
                    Consultation laConsultation = null;
                    try {
                        JSONObject lObject = new JSONObject(res);
                        laConsultation = new Consultation(lObject.getString("@id"), lObject.getString("dateHeure"), lObject.getString("motif"),
                                lObject.getString("etat"), lObject.getString("duree"), lObject.getString("medecin"), lObject.getString("patient"));
                        res = laConsultation.toString();
                        String date=laConsultation.getDateHeure().substring(0,10);
                        String heure=laConsultation.getDateHeure().substring(11,19);
                        txt_date_rdv.setText(date);
                        txt_heure_rdv.setText(heure);
                        txt_precisions.setText(laConsultation.getMotif());
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                    break;
                case "medecin":
                    TextView txt_medecin = (TextView) findViewById(R.id.txt_medecin);
                    try {
                        JSONObject lObject = new JSONObject(res);
                        txt_medecin.setText(lObject.getString("email"));
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
            }
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.details_consultation);
        String id = getIntent().getExtras().getString("id");
        TacheAsync maTache = new TacheAsync();
        maTache.execute(""+id,"GET");
        TacheAsync maTache2 = new TacheAsync();
        maTache2.execute(""+id,"medecin");

        Button btnChanger=findViewById(R.id.btn_valider_rdv);

        btnChanger.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }
}
