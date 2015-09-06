package com.care24.care24;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class MakeAppointment extends Activity {
	TextView DoctorName;
	TextView tvOr;
	TextView tvSpecialist;
	TextView tvEmail;
	TextView tvPhone;
	TextView tvAddress;
	
	Button btn_Bkash;
	Button btn_Bank;
	Button btn_MakeAppointment;
	EditText et_Bkash;
	EditText et_Bank;
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.vp_appointment_makeappointment_fragment);
        
        
        DoctorName = (TextView)findViewById(R.id.tvDoctorName_ma);
        tvOr = (TextView)findViewById(R.id.tvOr_ma);
        tvSpecialist = (TextView)findViewById(R.id.tvSpecialist_ma);
        tvEmail = (TextView)findViewById(R.id.tvEmail_ma);
        tvPhone = (TextView)findViewById(R.id.tvPhone_ma);
        tvAddress = (TextView)findViewById(R.id.tvAddress_ma);
        
        btn_Bkash = (Button) findViewById(R.id.btBkash_ma);
        btn_Bank = (Button) findViewById(R.id.btBank_ma);
        btn_MakeAppointment = (Button) findViewById(R.id.btMakeAppointment_ma);
        et_Bkash = (EditText) findViewById(R.id.etBkash_ma);
        et_Bank = (EditText)findViewById(R.id.etBank_ma);
        Intent intent = getIntent();
        String name = intent.getStringExtra("name");
        String specialist = intent.getStringExtra("specialist");
        String email = intent.getStringExtra("email");
        String phoneNo = intent.getStringExtra("phoneNo");
        String address = intent.getStringExtra("address");
        
        Toast.makeText(this, name, Toast.LENGTH_LONG).show();
        DoctorName.setText(name);
        tvSpecialist.setText(specialist);
        tvEmail.setText(email);
        tvPhone.setText(phoneNo);
        tvAddress.setText(address);
        
        //DoctorName.setVisibility(View.INVISIBLE);
        
        btn_Bkash.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				et_Bkash.setVisibility(View.VISIBLE);
				et_Bank.setVisibility(View.INVISIBLE);
				
			}
		});
        btn_Bank.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				et_Bank.setVisibility(View.VISIBLE);
				et_Bkash.setVisibility(View.INVISIBLE);
				
			}
		});
        
        btn_MakeAppointment.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Toast.makeText(MakeAppointment.this, "Youve successfully made an appointment",Toast.LENGTH_LONG).show();
				finish();
				
			}
		});
        
	}
}
