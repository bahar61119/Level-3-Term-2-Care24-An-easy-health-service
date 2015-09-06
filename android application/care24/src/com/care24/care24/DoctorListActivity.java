package com.care24.care24;

import java.util.ArrayList;
import java.util.HashMap;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;



import com.care24.*;
import com.care24.care24.javaclass.CommonUtilities;
import com.care24.json.ServiceHandler;

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
import android.widget.Toast;

public class DoctorListActivity extends ListActivity{
	private ProgressDialog pDialog;
	 
    // URL to get contacts JSON
    private static String url = ""+CommonUtilities.SERVER_URL+"/api.php/doctor_list/";
 
    // JSON Node names
    private static final String TAG_DOCTOR = "doctor";
    private static final String TAG_ID = "id";
    private static final String TAG_NAME = "name";
    private static final String TAG_EMAIL = "email";
    private static final String TAG_PHONE_NO = "phone_no";
    private static final String TAG_ADDRESS = "address";
    private static final String TAG_SPECIALIST = "specialist";
    //private static final String TAG_PHONE_MOBILE = "mobile";
    //private static final String TAG_PHONE_HOME = "home";
    //private static final String TAG_PHONE_OFFICE = "office";
 
    // contacts JSONArray
    JSONArray doctors = null;
 
    // Hashmap for ListView
    ArrayList<HashMap<String, String>> doctorList;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.doctor_list);
 
        doctorList = new ArrayList<HashMap<String, String>>();
 
        ListView lv = getListView();
 
        // Listview on item click listener
        lv.setOnItemClickListener(new OnItemClickListener() {
 
            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                    int position, long id) {
                // getting values from selected ListItem
                String name = ((TextView) view.findViewById(R.id.name))
                        .getText().toString();
                String email = ((TextView) view.findViewById(R.id.email))
                        .getText().toString();
                String address = ((TextView) view.findViewById(R.id.address))
                        .getText().toString();
                String specialist = ((TextView) view.findViewById(R.id.specialist))
                        .getText().toString();
 
                // Starting single contact activity
               /////////////////////////////////////////////////////////////
              /* Intent in = new Intent(getApplicationContext(),
                        Single_Contact_Activity.class);
                in.putExtra(TAG_NAME, name);
                in.putExtra(TAG_EMAIL, cost);
                in.putExtra(TAG_PHONE_MOBILE, description);
                startActivity(in);
                */
 
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
            pDialog = new ProgressDialog(DoctorListActivity.this);
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
                    doctors = jsonObj.getJSONArray(TAG_DOCTOR);
 
                    // looping through All Contacts
                    for (int i = 0; i < doctors.length(); i++) {
                        JSONObject c = doctors.getJSONObject(i);
                       
                        String id = c.getString(TAG_ID);
                        String name = c.getString(TAG_NAME);
                        String email = c.getString(TAG_EMAIL);
                        String address = c.getString(TAG_ADDRESS);
                        String specialist = c.getString(TAG_SPECIALIST);
                        String phone_no = c.getString(TAG_PHONE_NO);
                        // Phone node is JSON Object
                        
 
                        // tmp hashmap for single contact
                        HashMap<String, String> doctor = new HashMap<String, String>();
 
                        // adding each child node to HashMap key => value
                        doctor.put(TAG_ID, id);
                        doctor.put(TAG_ADDRESS, address);
                        doctor.put(TAG_NAME, name);
                        doctor.put(TAG_EMAIL, email);
                        doctor.put(TAG_SPECIALIST, specialist);
                        doctor.put(TAG_PHONE_NO, phone_no);
                        doctorList.add(doctor);
 
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
		                DoctorListActivity.this, doctorList,
		                R.layout.daoctor_layout, new String[] { TAG_NAME, TAG_EMAIL,
		                         TAG_ADDRESS, TAG_PHONE_NO , TAG_SPECIALIST}, new int[] { R.id.name,
		                        R.id.email, R.id.address,R.id.phone_no, R.id.specialist });

		        setListAdapter(adapter);
		    }

    }
   
   


}
