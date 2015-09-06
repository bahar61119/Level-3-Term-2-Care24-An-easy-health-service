package com.care24.care24.viewpagerfragments;

import android.app.ListFragment;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.View.OnClickListener;
import android.widget.Button;

import com.care24.care24.PrescriptionListActivity;
import com.care24.care24.R;
import com.care24.care24.ReportListActivity;

public class MyPrescriptionsFragment extends Fragment{

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		View rootView = inflater.inflate(R.layout.vp_myprescriptions_fragment, container, false);
		Button prescription_btn = (Button) rootView
				.findViewById(R.id.btn_prescription);
		prescription_btn.setOnClickListener(new OnClickListener() {
			public void onClick(View v) {
				// Toast.makeText(getActivity().getApplicationContext(),
				// "Button Click", Toast.LENGTH_SHORT).show();
				Intent intent = new Intent(getActivity(), PrescriptionListActivity.class);
				startActivity(intent);
			}
		});
		return rootView;
	}

	

}
