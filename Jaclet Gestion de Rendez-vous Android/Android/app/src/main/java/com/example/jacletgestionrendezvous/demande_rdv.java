package com.example.jacletgestionrendezvous;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;
import android.widget.ThemedSpinnerAdapter;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.DialogFragment;

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
import java.security.spec.ECField;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class demande_rdv extends AppCompatActivity implements DatePickerDialog.OnDateSetListener, TimePickerDialog.OnTimeSetListener{

    public class TacheAsync extends AsyncTask<String, Integer, String> {

        private String methode;
        @Override
        protected String doInBackground(String... arg){
            String res="";
            StringBuffer leBuffer = new StringBuffer(res);
            methode=arg[0];
            switch (methode){
                case "GET":
                    try {
                        URL url = new URL("http://192.168.1.68:8000/api/utilisateurs?page=1");
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
                        JSONObject Medecins = new JSONObject(res);
                        res = Medecins.getString("hydra:member");
                    } catch (Exception e) {
                        res = "erreur **********";
                        Log.i("oe",e.toString());
                    }
                    Log.i("oe",res);
                    break;
                case "POST":
                    try {
                        //object url et objet httpUrlConnection
                        URL url = new URL("http://192.168.1.69:8000/api/consultations");
                        HttpURLConnection conn = (HttpURLConnection) url.openConnection();

                        //methode et entrées/sorties
                        conn.setRequestMethod("POST");
                        conn.setDoInput(true);
                        conn.setDoOutput(true);
                        conn.setRequestProperty("Content-Type","application/json; charset=UTF-8");

                        OutputStream outputPost = conn.getOutputStream();
                        BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(outputPost, "UTF-8"));

                        String query = new JSONStringer()
                                .object()
                                .key("dateHeure").value(arg[1])
                                .key("motif").value(arg[2])
                                .key("etat").value("En cours")
                                .key("duree").value(arg[3])
                                .key("medecin").value(arg[4])
                                .key("patient").value("/api/patients/1")
                                .endObject()
                                .toString();

                        writer.write(query);
                        writer.flush();
                        writer.close();
                        outputPost.close();
                        conn.connect();

                        Log.i("oe",query);

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
                            Log.i("oe",String.valueOf(codeResponse)+" - "+conn.getResponseMessage());
                            res = "Erreur réponse *******";
                        }
                    }
                    catch (Exception e) {
                        Log.i("oe",e.toString());
                        res = "Erreur **********";
                    }
                    break;
            }
            return res;
        }

        @Override
        protected void onPostExecute(String res){
            switch(methode){
                case "GET":
                    ArrayList<User> lesUsers = new ArrayList<User>();
                    User leUser = null;
                    ArrayList<Medecin> lesMedecins = new ArrayList<Medecin>();
                    Medecin leMedecin = null;
                    JSONObject lObject = null;
                    JSONArray tous = null;
                    try {
                        tous = new JSONArray(res);
                        for (int i = 0; i < tous.length(); i++) {
                            lObject = tous.getJSONObject(i);
                            leUser = new User(lObject.getString("@id"), lObject.getString("email"), lObject.getString("password"), lObject.getString("roles"));
                            lesUsers.add(leUser);
                            Log.i("oe",leUser.getRoles());
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                    for (User unUser:lesUsers){
                        if(unUser.getRoles().contains("ROLE_MEDECIN")){
                            leMedecin=new Medecin(unUser.getId(),unUser.getEmail(),unUser.getPassword());
                            lesMedecins.add(leMedecin);
                        }
                    }
                    ArrayAdapter<Medecin> dataAdapter = new ArrayAdapter<Medecin>(demande_rdv.this, android.R.layout.simple_list_item_single_choice, lesMedecins);
                    Spinner affichage = (Spinner) findViewById(R.id.spinner_medecin);
                    affichage.setAdapter(dataAdapter);
                    break;
            }
            super.onPostExecute(res);
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.demande_rdv);

        TacheAsync tacheGet = new TacheAsync();
        tacheGet.execute("GET");

        Spinner spinner=findViewById(R.id.spinner_medecin);
        TextView Daterdv=findViewById(R.id.txt_date_rdv);
        TextView Heurerdv=findViewById(R.id.txt_heure);
        EditText Precisions=findViewById(R.id.txt_precisions);

        Button btnValider = (Button) findViewById(R.id.btn_valider_rdv);

        btnValider.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Medecin leMedecin=(Medecin) spinner.getSelectedItem();
                String txtdate=(String) Daterdv.getText();
                String txtheure=(String) Heurerdv.getText();
                String precisions= String.valueOf(Precisions.getText());
                String medecinid=leMedecin.getId();
                medecinid = medecinid.substring(medecinid.length() - 1, medecinid.length());

                medecinid = "/api/medecins/"+medecinid;
                txtheure+=":00";

                String date_heure=txtdate+"T"+txtheure+".975Z";
                String duree=txtdate+"T01:00:00.975Z";

                TacheAsync maTache = new TacheAsync();
                maTache.execute("POST",date_heure,precisions,duree,medecinid);
            }
        });

        Button button = (Button) findViewById(R.id.select_date_rdv);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DialogFragment datePicker = new DatePickerFragment();
                datePicker.show(getSupportFragmentManager(), "date picker");
            }
        });

        Button button2 = (Button) findViewById(R.id.select_heure);
        button2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v3) {
                DialogFragment timePicker = new TimePickerFragment();
                timePicker.show(getSupportFragmentManager(), "time picker");
            }
        });
    }

    @Override
    public void onDateSet(DatePicker view, int year, int month, int dayOfMonth) {
        String mois=String.valueOf(month + 1);
        if(mois.length()==1){
            mois="0"+mois;
        }
        String strdate=String.valueOf(year)+"-"+mois+"-"+String.valueOf(dayOfMonth);

        TextView textView = (TextView) findViewById(R.id.txt_date_rdv);
        textView.setText(strdate);
    }

    @Override
    public void onTimeSet(TimePicker view, int hourOfDay, int minute) {
        String Minute=String.valueOf(minute);
        if(Minute.length()==1){
            Minute="0"+Minute;
        }

        TextView textView = (TextView) findViewById(R.id.txt_heure);
        textView.setText(hourOfDay + ":" + Minute);
    }
}