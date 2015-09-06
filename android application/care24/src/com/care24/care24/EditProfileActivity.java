package com.care24.care24;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;

public class EditProfileActivity extends Activity {
	Button btn_EditProfile;
	 protected void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        setContentView(R.layout.vp_profile_editprofile_fragment);
	        btn_EditProfile = (Button)findViewById(R.id.btEditProfile);
	        
	        btn_EditProfile.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					Toast.makeText(EditProfileActivity.this, "Profile Edited...", Toast.LENGTH_LONG).show();
				    Intent intent = new Intent(EditProfileActivity.this, ViewPagerActivity.class);
			        startActivity(intent);
			        finish();
				
				}
			});
	        
	 }

}
