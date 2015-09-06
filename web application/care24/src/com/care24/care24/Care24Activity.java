package com.care24.care24;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class Care24Activity extends Activity {

	private EditText etUserName;
	private EditText etPassword;
	private Button btLogin;
	
    @Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		finish();
	}


	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_care24);
        
        
        btLogin = (Button) findViewById(R.id.btLogin);
        
        btLogin.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				etUserName = (EditText) findViewById(R.id.etUsername);
		        etPassword = (EditText) findViewById(R.id.etPassword);
		        Intent intent = new Intent(Care24Activity.this, ViewPagerActivity.class);
		        startActivity(intent);
			}
		});
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.care24, menu);
        return true;
    }
    
}
