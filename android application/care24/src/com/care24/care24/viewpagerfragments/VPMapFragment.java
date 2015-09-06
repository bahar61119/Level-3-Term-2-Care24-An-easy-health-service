package com.care24.care24.viewpagerfragments;

import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.care24.care24.AllHosDocListActivity;
import com.care24.care24.Care24Activity;
import com.care24.care24.EditProfileActivity;
import com.care24.care24.MakeAppointment;
import com.care24.care24.R;
import com.care24.care24.SignUpActivity;
import com.care24.care24.ViewPagerActivity;
import com.care24.care24.javaclass.CommonUtilities;
import com.care24.care24.javaclass.DatabaseHandler;
import com.care24.care24.javaclass.GPSTracker;
import com.care24.care24.javaclass.UserFunctions;
import com.google.android.gcm.GCMRegistrar;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.GoogleMap.InfoWindowAdapter;
import com.google.android.gms.maps.GoogleMap.OnInfoWindowClickListener;
import com.google.android.gms.maps.GoogleMap.OnMyLocationButtonClickListener;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

import android.R.integer;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.location.Address;
import android.location.Criteria;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.Settings;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

public class VPMapFragment extends Fragment implements LocationListener {

	private GoogleMap map;
	private static View rootView;
	// latitude and longitude
	double latitude;
	double longitude;
	MarkerOptions marker;
	LatLng latLng;
	Button btlocateme;
	JSONObject json;
	ArrayList<HashMap<String, String>> hospitalList;
	HashMap<Marker, HashMap<String, String>> hospitalID;
	HashMap<LatLng, HashMap<String, String> > hospitalLatLngID;
	MarkerOptions markerOptions;
	private String provider;
	private LocationManager locationManager;
	
	private static String KEY_SUCCESS = "success";
	private static String KEY_ERROR = "error";
	private static String KEY_ERROR_MSG = "error_msg";
	private static String KEY_HOS_ID = "id";
	private static String KEY_HOS_NAME = "h_name";
	private static String KEY_HOS_ADDRESS = "address";
	private static String KEY_HOS_LONGITUDE = "longitude";
	private static String KEY_HOS_LATITUDE = "latitude";
	private static String KEY_HOS_DETAILS = "details";
	private static String KEY_HOS_PHONE = "phone_no";
	private static String KEY_HOS_EMAIL = "email";
	private static String KEY_HOS_WEB = "website";
	private static String KEY_HOS_ENEMRGENCY_NO= "emergency_no";
	private static String KEY_HOS_AMBULANCE = "ambulance";
	private static String KEY_HOS_FAX = "fax_no";
	private static String KEY_HOS_ACTIVE = "active";

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		// TODO Auto-generated method stub

		rootView = inflater.inflate(R.layout.vp_map_fragment, container, false);
		hospitalList = new ArrayList<HashMap<String,String> >();
		hospitalLatLngID = new HashMap<LatLng,HashMap<String, String> >();
		hospitalID = new HashMap<Marker, HashMap<String, String> > ();
		try {
			// Loading map
			initializeMap();
			location_search();

		} catch (Exception e) {
			e.printStackTrace();
		}
		// setupMap();
		return rootView;
	}
	
	
	@Override
	public void onSaveInstanceState(Bundle outState) {
		// TODO Auto-generated method stub
		super.onSaveInstanceState(outState);
	}

	@Override
	public void onResume() {
		// TODO Auto-generated method stub
		super.onResume();
		initializeMap();
	}

	@Override
	public void onStop() {
		// TODO Auto-generated method stub
		if(getFragmentManager()!=null)
		{
			Fragment fragment = (getFragmentManager().findFragmentById(R.id.map));
			FragmentTransaction ft = getActivity().getSupportFragmentManager()
					.beginTransaction();
			ft.remove(fragment);
			ft.commitAllowingStateLoss();
		}
		super.onStop();
	}

	@Override
	public void onDetach() {
		// TODO Auto-generated method stub
		
		super.onDetach();

	}

	@Override
	public void onViewCreated(View view, Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onViewCreated(view, savedInstanceState);

		initializeMap();
	}
	
	private boolean isNetworkAvailable() {
	    ConnectivityManager connectivityManager 
	          = (ConnectivityManager) getActivity().getSystemService(Context.CONNECTIVITY_SERVICE);
	    NetworkInfo activeNetworkInfo = connectivityManager.getActiveNetworkInfo();
	    return activeNetworkInfo != null && activeNetworkInfo.isConnected();
	}

	private void initializeMap() {
		if (map == null) {
			map = ((SupportMapFragment) ViewPagerActivity.fragmentManager
					.findFragmentById(R.id.map)).getMap();

			// check if map is created successfully or not
			if (map == null) {
				Toast.makeText(getActivity().getApplicationContext(),
						"Map is not available", Toast.LENGTH_SHORT).show();
			} else {
				setupMap();
			}
		}
	}

	private void setupMap() {

		GPSTracker gps = new GPSTracker(getActivity().getApplicationContext());
		Location location = gps.getLocation();
		
		if(!isNetworkAvailable()){
			Toast.makeText(getActivity().getApplicationContext(),
					"Internet Connection is not available", Toast.LENGTH_LONG).show();
		}
		if(!gps.isGPSEnable()){
			showDialog();
		}
		if(!gps.canGetLocation()){
			location = gps.getLastKnowLocation();
		}
		
		map.setMyLocationEnabled(true);
		map.getUiSettings();
		map.setOnInfoWindowClickListener(new OnInfoWindowClickListener() {
	        @Override
	        public void onInfoWindowClick(Marker marker) {
	        	// Launch Appliaton Screen
	        	if(hospitalID.containsKey(marker))
	        	{
		        	HashMap<String, String> hospital = hospitalID.get(marker);
		        	// Launch Appliaton Screen
					Intent app = new Intent(getActivity().getApplicationContext(), AllHosDocListActivity.class);
					app.putExtra("id" , hospital.get(KEY_HOS_ID));
					startActivity(app);
	        	}
	        }
	    });
		CameraPosition cameraPosition = new CameraPosition.Builder()
				.target(new LatLng(location.getLatitude(), location
						.getLongitude())).zoom(14).build();

		map.animateCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));
		new GetHospitalList().execute();
		
		
		
		
	}
	
	public void addMarker(){
		for (int i = 0; i < hospitalList.size(); i++) {
			HashMap<String, String> hospital = hospitalList.get(i);	
			try{
				float latitude = Float.parseFloat(hospital.get(KEY_HOS_LATITUDE)) ;
				float longitude = Float.parseFloat(hospital.get(KEY_HOS_LONGITUDE)) ;
				String hosName = hospital.get(KEY_HOS_NAME);
				Marker m;
				LatLng latlng = new LatLng(latitude, longitude);
				hospitalLatLngID.put(latlng, hospital);
				m = map.addMarker(new MarkerOptions()
						.position(latlng)
						.title(hosName)
						.icon(BitmapDescriptorFactory
						.defaultMarker(BitmapDescriptorFactory.HUE_BLUE)));
				hospitalID.put(m, hospital);
				}catch(NumberFormatException e){
					e.printStackTrace();
				}
			
			
			
			/*map.setInfoWindowAdapter(new InfoWindowAdapter() {

				// Use default InfoWindow frame
				@Override
				public View getInfoWindow(Marker arg0) {
					return null;
				}
				
				 
				// Defines the contents of the InfoWindow
				@Override
				public View getInfoContents(Marker arg0) {

					// Getting view from the layout file info_window_layout
					View v = getActivity().getLayoutInflater().inflate(
							R.layout.windowlayout, null);

					// Getting the position from the marker
					LatLng latLng = arg0.getPosition();
					// Getting reference to the TextView to set latitude
					
					HashMap<String, String> hospital = hospitalID.get(arg0); 
					
					Log.d("Info:", latLng.toString());
					
					String name = hospital.get(KEY_HOS_NAME);
					
					TextView tvDate = (TextView) v
							.findViewById(R.id.tv_infowin_title);

					// Getting reference to the TextView to set longitude
					TextView tvHeight = (TextView) v
							.findViewById(R.id.tv_infowin_address);
					TextView tvDuration = (TextView) v
							.findViewById(R.id.tv_infowin_imer_phone);

					// Setting the date
					tvDate.setText(name);

					// Setting the flood height
					tvHeight.setText("Address:	" +hospital.get(KEY_HOS_ADDRESS));

					// Setting the flood duration
					tvDuration.setText("Emergency No:	" + hospital.get(KEY_HOS_ENEMRGENCY_NO));

					// Returning the view containing InfoWindow contents
					
					v.setLayoutParams(new ViewGroup.LayoutParams(20,20));
					return v;

				}
			});*/
		}
		
		
		
	}
	
	
	/**
	 * Async task class to get json by making HTTP call
	 * */
	private class GetHospitalList extends AsyncTask<Void, Void, Void> {
		private ProgressDialog pDialog;
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			// Showing progress dialog
			pDialog = new ProgressDialog(getActivity());
			pDialog.setMessage("Please wait...");
			pDialog.setCancelable(false);
			pDialog.show();

		}

		@Override
		protected Void doInBackground(Void... arg0) {
			// Creating service handler class instance
			UserFunctions userFunction = new UserFunctions();
			json = userFunction.hospitalInfo();
			try {
				JSONArray jsonArray = json.getJSONArray("hospital");
				for(int i=0;i<jsonArray.length();i++)
				{
					JSONObject jsonHospital = jsonArray.getJSONObject(i);
					Log.d("Hospital"+i,jsonHospital.toString());
					HashMap<String, String> hospital = new HashMap<String, String>();
					hospital.put(KEY_HOS_ACTIVE, jsonHospital.getString(KEY_HOS_ACTIVE));
					hospital.put(KEY_HOS_ADDRESS, jsonHospital.getString(KEY_HOS_ADDRESS));
					hospital.put(KEY_HOS_AMBULANCE, jsonHospital.getString(KEY_HOS_AMBULANCE));
					hospital.put(KEY_HOS_DETAILS, jsonHospital.getString(KEY_HOS_DETAILS));
					hospital.put(KEY_HOS_EMAIL, jsonHospital.getString(KEY_HOS_EMAIL));
					hospital.put(KEY_HOS_ENEMRGENCY_NO, jsonHospital.getString(KEY_HOS_ENEMRGENCY_NO));
					hospital.put(KEY_HOS_FAX, jsonHospital.getString(KEY_HOS_FAX));
					hospital.put(KEY_HOS_ID, jsonHospital.getString(KEY_HOS_ID));
					hospital.put(KEY_HOS_LATITUDE, jsonHospital.getString(KEY_HOS_LATITUDE));
					hospital.put(KEY_HOS_LONGITUDE, jsonHospital.getString(KEY_HOS_LONGITUDE));
					hospital.put(KEY_HOS_NAME, jsonHospital.getString(KEY_HOS_NAME));
					hospital.put(KEY_HOS_PHONE, jsonHospital.getString(KEY_HOS_PHONE));
					hospital.put(KEY_HOS_WEB, jsonHospital.getString(KEY_HOS_WEB));
					
					hospitalList.add(hospital);
					Log.d("Hospital"+i,hospitalList.toString());
					
				}
				
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			return null;
		}

		@Override
		protected void onPostExecute(Void result) {
			super.onPostExecute(result);
			// Dismiss the progress dialog
			if (pDialog.isShowing())
				pDialog.dismiss();
			
			Log.d("Hospital No: ", ""+hospitalList.toString());
			addMarker();
			
			
		}

	}

	@Override
	public void onLocationChanged(Location arg0) {
		// TODO Auto-generated method stub

	}

	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub

	}

	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub

	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub

	}
	
	
	public void location_search(){
		// Getting reference to btn_find of the layout activity_main
		Button btn_find = (Button) rootView.findViewById(R.id.btn_find);
		
		// Defining button click event listener for the find button
		OnClickListener findClickListener = new OnClickListener() {
					@Override
					public void onClick(View v) {
						// Getting reference to EditText to get the user input location
						EditText etLocation = (EditText) getActivity().findViewById(
								R.id.et_location);

						// Getting user input location
						String location = etLocation.getText().toString();

						if (location != null && !location.equals("")) {
							new GeocoderTask().execute(location);
						}
					}
				};

		// Setting button click event listener for the find button
		btn_find.setOnClickListener(findClickListener);
		
	}
	
	
	// An AsyncTask class for accessing the GeoCoding Web Service
		private class GeocoderTask extends AsyncTask<String, Void, List<Address>>{
			
			@Override
			protected List<Address> doInBackground(String... locationName) {
				// Creating an instance of Geocoder class
				Geocoder geocoder = new Geocoder(getActivity().getBaseContext());
				List<Address> addresses = null;
				
				try {
					// Getting a maximum of 3 Address that matches the input text
					addresses = geocoder.getFromLocationName(locationName[0], 3);
				} catch (IOException e) {
					e.printStackTrace();
				}		
			
				
				return addresses;
			}
			
			
			@Override
			protected void onPostExecute(List<Address> addresses) {
				
		        if(addresses==null || addresses.size()==0){
					Toast.makeText(getActivity().getBaseContext(), "No Location found", Toast.LENGTH_SHORT).show();
				}
		        else{
			        
			        // Adding Markers on Google Map for each matching address
					for(int i=0;i<addresses.size();i++){				
						
						Address address = (Address) addresses.get(i);
						
				        // Creating an instance of GeoPoint, to display in Google Map
				        latLng = new LatLng(address.getLatitude(), address.getLongitude());
				        
				        
				        String addressText = String.format("%s, %s",
		                        address.getMaxAddressLineIndex() > 0 ? address.getAddressLine(0) : "",
		                        address.getCountryName());
	
				        markerOptions = new MarkerOptions();
				        markerOptions.position(latLng);
				        markerOptions.title(addressText);
	
				        map.addMarker(markerOptions);
				        
				        // Locate the first location
				        if(i==0)			        	
							map.animateCamera(CameraUpdateFactory.newLatLng(latLng)); 	
					}	
		        }
			}		
		}

	

	void showDialog() {
		DialogFragment newFragment = MyAlertDialogFragment.newInstance("GPS is not Enable","Want to Enable GPS?");
		newFragment.show(getActivity().getFragmentManager(), "dialog");
	}

	static public void doPositiveClick() {

		 
		// myIntent.putExtra("key", value); //Optional parameters
	}

	static public void doNegativeClick() {

	}
	
	public static class MyAlertDialogFragment extends DialogFragment {

		public static MyAlertDialogFragment newInstance(String title, String msg) {
			MyAlertDialogFragment frag = new MyAlertDialogFragment();
			Bundle args = new Bundle();
			args.putString("title", title);
			args.putString("msg", msg);
			frag.setArguments(args);
			return frag;
		}

		@Override
		public Dialog onCreateDialog(Bundle savedInstanceState) {
			String title = getArguments().getString("title");
			String msg = getArguments().getString("msg");

			return new AlertDialog.Builder(getActivity())
					.setTitle(title)
					.setMessage(msg)
					.setPositiveButton("Settings",
							new DialogInterface.OnClickListener() {
								public void onClick(DialogInterface dialog,
										int whichButton) {
									Intent intent = new Intent(android.provider.Settings.ACTION_LOCATION_SOURCE_SETTINGS);
									startActivity(intent);
								}
							})
					.setNegativeButton("No",
							new DialogInterface.OnClickListener() {
								public void onClick(DialogInterface dialog,
										int whichButton) {
									VPMapFragment.doNegativeClick();
								}
							}).create();
		}
	}

}
