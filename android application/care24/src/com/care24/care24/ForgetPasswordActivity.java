package com.care24.care24;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;

public class ForgetPasswordActivity extends Activity {
	Button send;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.forgot_password);

		send = (Button) findViewById(R.id.btSend);
		send.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent intent = new Intent(ForgetPasswordActivity.this,
						Care24Activity.class);
				startActivity(intent);
				finish();

				
			}
		});
	}

}
