package com.care24.care24.viewpagerfragments;

import java.util.HashMap;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.care24.care24.Care24Activity;
import com.care24.care24.EditProfileActivity;
import com.care24.care24.R;
import com.care24.care24.javaclass.DatabaseHandler;

public class ProfileFragment extends Fragment{
	
	//Button btn_editProfile;
	private View rootview;
	TextView tvName;
	TextView tvUsername;
	TextView tvAge;
	TextView tvWeight;
	TextView tvSex;
	TextView tvEmail;
	TextView tvAddress;
	
	
	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		
		// TODO Auto-generated method stub
		
		View rootView = inflater.inflate(R.layout.vp_profile_fragment, container, false);
		Button btn_editProfile = (Button)rootView.findViewById(R.id.btEditProfile);
		tvName = (TextView) rootView.findViewById(R.id.tvFullName);
		tvUsername = (TextView) rootView.findViewById(R.id.tvUsername2_profile);
		tvAge = (TextView) rootView.findViewById(R.id.tvAge2_profile);
		tvWeight = (TextView) rootView.findViewById(R.id.tvWeight2_profile);
		tvSex = (TextView) rootView.findViewById(R.id.tvSex2_profile);
		tvEmail = (TextView) rootView.findViewById(R.id.tvEmail2_profile);
		tvAddress = (TextView) rootView.findViewById(R.id.tvAddress2_profile);
		
		DatabaseHandler db = new DatabaseHandler(getActivity().getApplicationContext());
		HashMap<String,String> user = db.getUserDetails();
		
		tvName.setText(user.get("name"));
		tvUsername.setText(user.get("username"));
		tvAge.setText(user.get("age"));
		tvWeight.setText(user.get("weight"));
		tvSex.setText(user.get("sex"));
		tvEmail.setText(user.get("email"));
		tvAddress.setText(user.get("address"));
		
		
		
		btn_editProfile.setOnClickListener(new OnClickListener() {
			
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
			// Toast.makeText(getActivity(), "Hiiii", Toast.LENGTH_LONG).show();
			 
			 Intent myIntent = new Intent(getActivity(), EditProfileActivity.class);
			// myIntent.putExtra("key", value); //Optional parameters
			 getActivity().startActivity(myIntent);
			}
		});
		
		return rootView;
	}

	

}
