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

public class MedicineListActivity extends ListActivity{
	private ProgressDialog pDialog;
	 
    // URL to get contacts JSON
    private static String url;
    private String p_id;
    
    // JSON Node names
    private static final String TAG_MED_NAME = "med_name";
    private static final String TAG_REGULATION = "regulation";
    private static final String TAG_DETAILS = "details";
    
    private static final String TAG_DOSE = "dose";
    
    private static final String TAG_MEDICINE = "medicine";
    //private static final String TAG_PHONE_NO = "phone_no";
    //private static final String TAG_ADDRESS = "address";
    //private static final String TAG_SPECIALIST = "specialist";
    //private static final String TAG_PHONE_MOBILE = "mobile";
    //private static final String TAG_PHONE_HOME = "home";
    //private static final String TAG_PHONE_OFFICE = "office";
 
    // contacts JSONArray
    JSONArray medicines = null;
 
    // Hashmap for ListView
    ArrayList<HashMap<String, String>> medicineList;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.medicine_list);
        p_id = this.getIntent().getStringExtra("p_id");
		//dept_id= this.getIntent().getStringExtra("dept_id");
		
        medicineList = new ArrayList<HashMap<String, String>>();
 
        ListView lv = getListView();
 
        // Listview on item click listener
        lv.setOnItemClickListener(new OnItemClickListener() {
 
            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                    int position, long id) {
                
             	//String d_id = ((TextView) view.findViewById(R.id.d_id))
                         //.getText().toString();
                                // Starting single contact activity
                /////////////////////////////////////////////////////////////
                Intent in = new Intent(getApplicationContext(),
                         AppointmentFormActivity.class);
                // in.putExtra(TAG_ID, d_id);
                 //in.putExtra(TAG_H_ID, h_id);
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
            pDialog = new ProgressDialog(MedicineListActivity.this);
            pDialog.setMessage("Please wait...");
            pDialog.setCancelable(false);
            pDialog.show();
 
        }

		@Override
		protected Void doInBackground(Void... params) {
			  // Creating service handler class instance
            ServiceHandler sh = new ServiceHandler();
            url= ""+CommonUtilities.SERVER_URL+"/api.php/medicine/"+p_id+"/";

            Log.d("Response: ", "> " + url);
 
            // Making a request to url and getting response
            String jsonStr = sh.makeServiceCall(url, ServiceHandler.GET);
 
            Log.d("Response: ", "> " + jsonStr);
            //Toast.makeText(getBaseContext(), jsonStr,Toast.LENGTH_LONG ).show();
            
            if (jsonStr != null) {
                try {
                    JSONObject jsonObj = new JSONObject(jsonStr);
                     
                    // Getting JSON Array node
                    medicines = jsonObj.getJSONArray(TAG_MEDICINE);
 
                    // looping through All Contacts
                    for (int i = 0; i < medicines.length(); i++) {
                        JSONObject c = medicines.getJSONObject(i);
                       
                        String regulation = c.getString(TAG_REGULATION);
                        String med_name = c.getString(TAG_MED_NAME);
                        
                        //if(c.getString(TAG_EMAIL) != null){
                        //String email = c.getString(TAG_EMAIL);
                        //}
                        //String address = c.getString(TAG_ADDRESS);
                        String details = c.getString(TAG_DETAILS);
                        //String phone_no = c.getString(TAG_PHONE_NO);
                        // Phone node is JSON Object
                        String dose = c.getString(TAG_DOSE);
                        
 
                        // tmp hashmap for single contact
                        HashMap<String, String> medicine = new HashMap<String, String>();
 
                        // adding each child node to HashMap key => value
                        medicine.put(TAG_MED_NAME, med_name);
                        //doctor.put(TAG_ADDRESS, address);
                        medicine.put(TAG_REGULATION, regulation);
                        
                        //doctor.put(TAG_EMAIL, email);
                        
                        medicine.put(TAG_DETAILS, details);
                        medicine.put(TAG_DOSE, dose);
                        medicineList.add(medicine);
 
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
		                MedicineListActivity.this, medicineList,
		                R.layout.medicine_layout, new String[] { TAG_MED_NAME,TAG_REGULATION,
		                		TAG_DETAILS,TAG_DOSE}, new int[] { 
		                		R.id.med_name,R.id.regulation,
		                         R.id.details,R.id.dose });

		        setListAdapter(adapter);
		    }

    }
   
   


}
