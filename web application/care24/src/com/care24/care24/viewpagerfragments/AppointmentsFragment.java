package com.care24.care24.viewpagerfragments;

import com.care24.*;
import com.care24.care24.CategoryListActivity;
import com.care24.care24.DoctorListActivity;
import com.care24.care24.HospitalListActivity;
import com.care24.care24.R;

import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.View.OnClickListener;
import android.widget.Button;

public class AppointmentsFragment extends Fragment{
	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		View rootView = inflater.inflate(R.layout.vp_appointment_fragment, container, false);
		Button category_btn = (Button) rootView
				.findViewById(R.id.btn_category);
		Button doctor_btn = (Button) rootView
				.findViewById(R.id.btn_doctor);
		Button hospital_btn = (Button) rootView
				.findViewById(R.id.btn_hospital);
		category_btn.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				// Toast.makeText(getActivity().getApplicationContext(),
				// "Button Click", Toast.LENGTH_SHORT).show();
				Intent intent = new Intent(getActivity(), CategoryListActivity.class);
				startActivity(intent);
			}
		});
		doctor_btn.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				//Toast.makeText(getActivity().getApplicationContext(),
				// "Button Click", Toast.LENGTH_SHORT).show();
				Intent intent = new Intent(getActivity(), DoctorListActivity.class);
				startActivity(intent);
			}
		});
		hospital_btn.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				//Toast.makeText(getActivity().getApplicationContext(),
				// "Button Click", Toast.LENGTH_SHORT).show();
				Intent intent = new Intent(getActivity(), HospitalListActivity.class);
				startActivity(intent);
			}
		});
		return rootView;
	}
}
