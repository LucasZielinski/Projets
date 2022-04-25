package com.example.jacletgestionrendezvous;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class ecran_accueil extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ecran_accueil);

        Button btnChanger=findViewById(R.id.btn_valider);
        btnChanger.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v2) {
                Intent mainActivity2=new Intent(ecran_accueil.this, ecran_patient.class);
                startActivity(mainActivity2);
            }
        });
    }
}