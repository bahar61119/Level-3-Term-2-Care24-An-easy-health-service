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
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.care24.care24.javaclass.CommonUtilities;
import com.care24.json.ServiceHandler;

public class PresReportListActivity extends ListActivity{
	private ProgressDialog pDialog;
	 
    // URL to get contacts JSON
    private static String url ;
    HashMap<String,String> user=null;
    // JSON Node names
    private static final String TAG_REPORT = "report";
    private static final String TAG_ID = "p_id";
    private static final String TAG_DATE = "date";
    private static final String TAG_PDF = "pdf";
    //private static final String TAG_DISEASE = "disease";
    //private static final String TAG_SUGGESTION = "suggestion";
    String p_id;
    JSONArray prescriptions = null;
    //DatabaseHandler db_in=null;
    // Hashmap for ListView
    ArrayList<HashMap<String, String>> prescriptionList;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
      //  final DatabaseHandler db_in=new DatabaseHandler(getApplicationContext());
    	//user=db_in.getUserDetails();
    	
        setContentView(R.layout.pres_report_list);
   	     p_id = this.getIntent().getStringExtra("p_id");
        prescriptionList = new ArrayList<HashMap<String, String>>();
 
        ListView lv = getListView();
 
        // Listview on item click listener
        lv.setOnItemClickListener(new OnItemClickListener() {
 
            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                    int position, long id) {
                // getting values from selected ListItem
                String pdf = ((TextView) view.findViewById(R.id.pdf))
                        .getText().toString();
                Toast.makeText(getApplicationContext(), pdf, Toast.LENGTH_LONG).show();
                ///String email = ((TextView) view.findViewById(R.id.email))
                   //     .getText().toString();
                //String address = ((TextView) view.findViewById(R.id.address))
                  //      .getText().toString();
                //String specialist = ((TextView) view.findViewById(R.id.specialist))
                  //      .getText().toString();
 
                // Starting single contact activity
               /////////////////////////////////////////////////////////////
               Intent in = new Intent(getApplicationContext(),
                        PDFFromServerActivity.class);
                in.putExtra(TAG_PDF, pdf);
                //in.putExtra(TAG_EMAIL, cost);
                //in.putExtra(TAG_PHONE_MOBILE, description);
                startActivity(in);
                
 
            }
        });
 ////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////
        // Calling async task to get json
        new GetPrescriptions().execute();
    }
    
    /**
     * Async task class to get json by making HTTP call
     * */
    private class GetPrescriptions extends AsyncTask<Void, Void, Void> {
 
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            // Showing progress dialog
            pDialog = new ProgressDialog(PresReportListActivity.this);
            pDialog.setMessage("Please wait...");
            pDialog.setCancelable(false);
            pDialog.show();
 
        }

		@Override
		protected Void doInBackground(Void... params) {
			  // Creating service handler class instance
            ServiceHandler sh = new ServiceHandler();
            url= ""+CommonUtilities.SERVER_URL+"/api.php/report/"+p_id+"/";
            // Making a request to url and getting response
            String jsonStr = sh.makeServiceCall(url, ServiceHandler.GET);
            Log.d("url>>",url);
            Log.d("Response: ", "> " + jsonStr);
            //Toast.makeText(getBaseContext(), jsonStr,Toast.LENGTH_LONG ).show();
            
            if (jsonStr != null) {
                try {
                    JSONObject jsonObj = new JSONObject(jsonStr);
                     
                    // Getting JSON Array node
                    prescriptions = jsonObj.getJSONArray(TAG_REPORT);
 
                    // looping through All Contacts
                    for (int i = 0; i < prescriptions.length(); i++) {
                        JSONObject c = prescriptions.getJSONObject(i);
                       
                        //String id = c.getString(TAG_ID);
                        //String name = c.getString(TAG_NAME);
                        String date = c.getString(TAG_DATE);
                        //String doc_sig = c.getString(TAG_DOC_SIG);
                        //String specialist = c.getString(TAG_SPECIALIST);
                        String p_id = c.getString(TAG_ID);
                        //String disease=c.getString(TAG_DISEASE);
                        //String suggestion=c.getString(TAG_SUGGESTION);
                        String pdf= c.getString(TAG_PDF);
                        // Phone node is JSON Object
                        
 
                        // tmp hashmap for single contact
                        HashMap<String, String> prescription = new HashMap<String, String>();
 
                        // adding each child node to HashMap key => value
                        //prescription.put(TAG_NAME, name);
                        prescription.put(TAG_DATE, date);
                        prescription.put(TAG_ID, p_id);
                        prescription.put(TAG_PDF, pdf);
                       // prescription.put(TAG_DISEASE, disease);
                        //prescription.put(TAG_SUGGESTION, suggestion);
                        //doctor.put(TAG_SPECIALIST, specialist);
                        //hospital.put(TAG_PHONE_NO, phone_no);
                        prescriptionList.add(prescription);
 
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
		                PresReportListActivity.this, prescriptionList,
		                R.layout.pres_report_layout, new String[] { 
		                         TAG_DATE, TAG_ID, TAG_PDF },
		                         new int[] { R.id.date,R.id.p_id,R.id.pdf});

		        setListAdapter(adapter);
		    }

    }



}
