package com.care24.care24;

import java.util.ArrayList;
import java.util.HashMap;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.Context;
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
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;

import com.care24.json.ServiceHandler;
import com.care24.care24.javaclass.*;
public class CategoryListActivity extends ListActivity{
	private ProgressDialog pDialog;
	 
    // URL to get contacts JSON
    private static String url = ""+CommonUtilities.SERVER_URL+"/api.php/department_list/";
 
    // JSON Node names
    private static final String TAG_DEPARTMENT="department";
    private static final String TAG_ID = "id";
    private static final String TAG_DEPARTMENT_NAME = "department_name";
    private static final String TAG_DETAILS = "details";
    
   
    //private static final String TAG_PHONE_MOBILE = "mobile";
    //private static final String TAG_PHONE_HOME = "home";
    //private static final String TAG_PHONE_OFFICE = "office";
 
    // contacts JSONArray = "doctor";
    JSONArray categorys = null;
    // Hashmap for ListView
    ArrayList<HashMap<String, String>> categoryList;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.category_list);
        final DatabaseHandler db_in=new DatabaseHandler(getApplicationContext());
    	HashMap<String,String> user=db_in.getUserDetails();
    	Toast.makeText(getApplicationContext(), ""+user.get("name"), Toast.LENGTH_LONG).show();
        categoryList = new ArrayList<HashMap<String, String>>();
 
        ListView lv = getListView();
        
        // Listview on item click listener
        lv.setOnItemClickListener(new OnItemClickListener() {
 
            @Override
            public void onItemClick(AdapterView<?> parent, View view,
                    int position, long id) {
                // getting values from selected ListItem
        //    	db_in.resetTables();
                String cat_id = ((TextView) view.findViewById(R.id.cat_id))
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
                        CatHosListActivity.class);
                in.putExtra(TAG_ID, cat_id);
              //  in.putExtra(TAG_EMAIL, cost);
                //in.putExtra(TAG_PHONE_MOBILE, description);
                startActivity(in);
                
 
            }
        });
 ////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////
        // Calling async task to get json
        new GetCategorys().execute();
    }
    
    /**
     * Async task class to get json by making HTTP call
     * */
    private class GetCategorys extends AsyncTask<Void, Void, Void> {
 
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            // Showing progress dialog
            pDialog = new ProgressDialog(CategoryListActivity.this);
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
                    categorys = jsonObj.getJSONArray(TAG_DEPARTMENT);
 
                    // looping through All Contacts
                    for (int i = 0; i < categorys.length(); i++) {
                        JSONObject c = categorys.getJSONObject(i);
                       
                       // String id = c.getString(TAG_ID);
                        String department_name = c.getString(TAG_DEPARTMENT_NAME);
                        String details = c.getString(TAG_DETAILS);
                        String id = c.getString(TAG_ID);
                        
                        //String address = c.getString(TAG_ADDRESS);
                        //String specialist = c.getString(TAG_SPECIALIST);
                        //String phone_no = c.getString(TAG_PHONE_NO);
                        // Phone node is JSON Object
                        
                        //Log.d("Response: ", "> " + id+department_name+details);
                        // tmp hashmap for single contact
                        HashMap<String, String> category = new HashMap<String, String>();
 
                        // adding each child node to HashMap key => value
                        //category.put(TAG_ID, id);
                        category.put(TAG_DEPARTMENT_NAME, department_name);
                        category.put(TAG_DETAILS, details);
                        category.put(TAG_ID, id);
                        
                        //doctor.put(TAG_NAME, name);
                        //doctor.put(TAG_EMAIL, email);
                        //doctor.put(TAG_SPECIALIST, specialist);
                        //doctor.put(TAG_PHONE_NO, phone_no);
                        categoryList.add(category);
 
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
		                CategoryListActivity.this, categoryList,
		                R.layout.category_layout, new String[] { TAG_DEPARTMENT_NAME, TAG_DETAILS,
		                         TAG_ID}, new int[] { R.id.cat_name,R.id.details,R.id.cat_id});

		        setListAdapter(adapter);
		    }

    }
   
   

}
