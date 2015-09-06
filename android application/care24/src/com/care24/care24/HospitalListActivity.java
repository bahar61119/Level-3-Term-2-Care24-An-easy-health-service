package com.care24.care24;

import java.util.ArrayList;
import java.util.HashMap;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

import com.care24.care24.javaclass.CommonUtilities;
import com.care24.json.ServiceHandler;

public class HospitalListActivity extends ListActivity{
	private ProgressDialog pDialog;
	 
    // URL to get contacts JSON
    private static String url = ""+CommonUtilities.SERVER_URL+"/api.php/hospital/";
 
    // JSON Node names
    private static final String TAG_HOSPITAL = "hospital";
    private static final String TAG_ID = "id";
    private static final String TAG_NAME = "h_name";
    private static final String TAG_EMAIL = "email";
    private static final String TAG_PHONE_NO = "phone_no";
    private static final String TAG_ADDRESS = "address";
    private static final String TAG_DETAILS = "details";
    private static final String TAG_WEBSITE = "website";
    private static final String TAG_EMERGENCY_NO = "emergency_no";
    private static final String TAG_AMBULANCE = "ambulance";
    
    //private static final String TAG_PHONE_MOBILE = "mobile";
    //private static final String TAG_PHONE_HOME = "home";
    //private static final String TAG_PHONE_OFFICE = "office";
 
    // contacts JSONArray
    JSONArray hospitals = null;
 
    // Hashmap for ListView
    ArrayList<HashMap<String, String>> hospitalList;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.hospital_list);
 
        hospitalList = new ArrayList<HashMap<String, String>>();

		
		
        ListView lv = getListView();
 
        // Listview on item click listener
        lv.setOnItemClickListener(new OnItemClickListener() {
 
            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                    int position, long id) {
            	String h_id = ((TextView) view.findViewById(R.id.h_id))
                        .getText().toString();
                //String email = ((TextView) view.findViewById(R.id.email))
                  //      .getText().toString();
                //String address = ((TextView) view.findViewById(R.id.address))
                  //      .getText().toString();
                //String specialist = ((TextView) view.findViewById(R.id.specialist))
                  //      .getText().toString();
 
                // Starting single contact activity
               /////////////////////////////////////////////////////////////
               Intent in = new Intent(getApplicationContext(),
                        AllHosDocListActivity.class);
                in.putExtra(TAG_ID, h_id);
              //  in.putExtra(TAG_EMAIL, cost);
                //in.putExtra(TAG_PHONE_MOBILE, description);
                startActivity(in);
 
            }
        });
 ////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////
        // Calling async task to get json
        new GetDoctors().execute();
    }
    
    /**
     * Async task class to get json by making HTTP call
     * */
    private class GetDoctors extends AsyncTask<Void, Void, Void> {
 
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            // Showing progress dialog
            pDialog = new ProgressDialog(HospitalListActivity.this);
            pDialog.setMessage("Please wait...");
            pDialog.setCancelable(false);
            pDialog.show();
 
        }

		@Override
		protected Void doInBackground(Void... params) {
			  // Creating service handler class instance
            ServiceHandler sh = new ServiceHandler();
 
            // Making a request to url and getting response
            String jsonStr = sh.makeServiceCall(url, ServiceHandler.GET);
 
            Log.d("Response: ", "> " + jsonStr);
            //Toast.makeText(getBaseContext(), jsonStr,Toast.LENGTH_LONG ).show();
            
            if (jsonStr != null) {
                try {
                    JSONObject jsonObj = new JSONObject(jsonStr);
                     
                    // Getting JSON Array node
                    hospitals = jsonObj.getJSONArray(TAG_HOSPITAL);
 
                    // looping through All Contacts
                    for (int i = 0; i < hospitals.length(); i++) {
                        JSONObject c = hospitals.getJSONObject(i);
                       
                        String id = c.getString(TAG_ID);
                        String name = c.getString(TAG_NAME);
                        String email = c.getString(TAG_EMAIL);
                        String address = c.getString(TAG_ADDRESS);
                        //String specialist = c.getString(TAG_SPECIALIST);
                        String phone_no = c.getString(TAG_PHONE_NO);
                        // Phone node is JSON Object
                        
 
                        // tmp hashmap for single contact
                        HashMap<String, String> hospital = new HashMap<String, String>();
 
                        // adding each child node to HashMap key => value
                        hospital.put(TAG_ID, id);
                        hospital.put(TAG_ADDRESS, address);
                        hospital.put(TAG_NAME, name);
                        hospital.put(TAG_EMAIL, email);
                        //doctor.put(TAG_SPECIALIST, specialist);
                        hospital.put(TAG_PHONE_NO, phone_no);
                        hospitalList.add(hospital);
 
                        // adding contact to contact list
                       // if(name=="Ravi Tamada")
                        //{
                        	//Toast.makeText(getBaseContext(), name, Toast.LENGTH_LONG).show();
                             //contactList.add(contact);
                        //}
                         //else
                        	//continue;
                         
                       
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } else {
                Log.e("ServiceHandler", "Couldn't get any data from the url");
            }
 
            return null;
		}
		@Override
		 protected void onPostExecute(Void result) {
		        super.onPostExecute(result);
		        // Dismiss the progress dialog
		        if (pDialog.isShowing())
		            pDialog.dismiss();
		        /**
		         * Updating parsed JSON data into ListView
		         * */
		        ListAdapter adapter = new SimpleAdapter(
		                HospitalListActivity.this, hospitalList,
		                R.layout.hospital_layout, new String[] { TAG_NAME, TAG_EMAIL,
		                         TAG_ADDRESS, TAG_PHONE_NO, TAG_ID}, new int[] { R.id.name,
		                        R.id.email, R.id.address,R.id.phone_no,R.id.h_id });

		        setListAdapter(adapter);
		    }

    }
   
   


}
