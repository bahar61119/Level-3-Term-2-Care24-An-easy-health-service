package com.care24.care24;

import java.util.HashMap;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;
import android.widget.Spinner;
import android.widget.Toast;

import com.care24.care24.*;
import com.care24.care24.javaclass.DatabaseHandler;
import com.care24.care24.javaclass.UserFunctions;
import com.care24.care24.javaclass.CommonUtilities;
import com.care24.care24.javaclass.AlertDialogManager;
import com.care24.care24.javaclass.ConnectionDetector;
import com.care24.care24.javaclass.WakeLocker;
import com.google.android.gcm.GCMRegistrar;

public class SignUpActivity extends Activity {
	
	EditText etName;
	EditText etUserName;
	EditText etPassword;
	EditText etConfirmPassword;
	EditText etPhone;
	EditText etAddress;
	EditText etEmail;
	EditText etAge;
	Spinner spinnerSex;
	EditText etWeight;
	Button signUp;
	JSONObject json;
	
	private ProgressDialog pDialog;
	private boolean registration;
	// Alert dialog manager
    private AlertDialogManager alert = new AlertDialogManager();
    // Connection detector
 	private ConnectionDetector cd;
 	// Get GCM registration id
    private String gcm_regid;
	// JSON Response node names
	private static String KEY_SUCCESS = "success";
	private static String KEY_ERROR = "error";
	private static String KEY_ERROR_MSG = "error_msg";
	private static String KEY_ID = "id";
	private static String KEY_NAME = "name";
	private static String KEY_PHONE = "phone";
	private static String KEY_ADDRESS = "address";
	private static String KEY_EMAIL = "email";
	private static String KEY_USERNAME = "username";
	private static String KEY_PASSWORD = "password";
	private static String KEY_AGE = "age";
	private static String KEY_SEX = "sex";
	private static String KEY_WEIGHT = "weight";
	private static String KEY_GCM_REGID = "gcm_regid";
	
	
	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.signup);
        
        cd = new ConnectionDetector(getApplicationContext());
        
        // Check if Internet present
     	if (!cd.isConnectingToInternet()) {
     		// Internet Connection is not present
     		alert.showAlertDialog(SignUpActivity.this,
     				"Internet Connection Error",
     				"Please connect to Internet connection", false);
     		// stop executing code by return
     		return;
     	}
     	
     	// Make sure the device has the proper dependencies.
     	GCMRegistrar.checkDevice(this);

     	// Make sure the manifest was properly set - comment out this line
     	// while developing the app, then uncomment it when it's ready.
     	GCMRegistrar.checkManifest(this);
     	
     	
		
		// Get GCM registration id
		//gcm_regid = GCMRegistrar.getRegistrationId(this);

		GCMRegistrar.unregister(this);
		GCMRegistrar.register(this, CommonUtilities.SENDER_ID);
		
	    
	    
        registration = false;
        etName = (EditText) findViewById(R.id.etName);
		etUserName = (EditText) findViewById(R.id.etUserName);
		etPassword = (EditText) findViewById(R.id.etPassword);
		etConfirmPassword = (EditText) findViewById(R.id.etConfirmPassword);
		etPhone = (EditText) findViewById(R.id.etPhone);
		etAddress = (EditText) findViewById(R.id.etAddress);
		etEmail = (EditText) findViewById(R.id.etEmail);
		etAge = (EditText) findViewById(R.id.etAge);
		spinnerSex = (Spinner) findViewById(R.id.spinnerSex);
		etWeight = (EditText) findViewById(R.id.etWeight); 
        signUp = (Button)findViewById(R.id.btSignup);
        
        signUp.setOnClickListener(new OnClickListener() {
		
		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			
			// Calling async task to get json
			new Signup().execute();
			
			//Toast.makeText(SignUpActivity.this, ""+name+" "+phone+" "+address+" "+email+" "+username+" "+password+" "+confirmpassword+" "+age+" "+sex+" "+weight, Toast.LENGTH_LONG).show();
	        //Intent intent = new Intent(SignUpActivity.this, ViewPagerActivity.class);
	        //startActivity(intent);
	        //finish();
		}
	});
        
	}
	
	
	
	/**
	 * Async task class to get json by making HTTP call
	 * */
	private class Signup extends AsyncTask<Void, Void, Void> {

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			// Showing progress dialog
			pDialog = new ProgressDialog(SignUpActivity.this);
			pDialog.setMessage("Please wait...");
			pDialog.setCancelable(false);
			pDialog.show();

		}

		@Override
		protected Void doInBackground(Void... arg0) {
			// Creating service handler class instance
			
			while(!CommonUtilities.IS_GCM_REGSTRATION);
			// Get GCM registration id
		    gcm_regid = CommonUtilities.GCM_REGSTRATION_ID;
		    
		    if(CommonUtilities.IS_GCM_REGSTRATION){

			String name = etName.getText().toString();
			String phone = etPhone.getText().toString();
			String address = etAddress.getText().toString();
			String email = etEmail.getText().toString();
			String username = etUserName.getText().toString();
			String password = etPassword.getText().toString();
			String confirmpassword = etConfirmPassword.getText().toString();
			String age = etAge.getText().toString();
			String sex = spinnerSex.getSelectedItem().toString();
			String weight = etWeight.getText().toString();
			//Toast.makeText(SignUpActivity.this, ""+name+" "+phone+" "+address+" "+email+" "+username+" "+password+" "+confirmpassword+" "+age+" "+sex+" "+weight, Toast.LENGTH_LONG).show();
	        
			
			UserFunctions userFunction = new UserFunctions();
			json = userFunction.registerUser(name, phone, address, email, username, password, age, sex, weight, gcm_regid);
			
			
			
			// check for login response
			try {
				if (json.getString(KEY_SUCCESS) != null) {
					//registerErrorMsg.setText("");
					GCMRegistrar.setRegisteredOnServer(getApplicationContext(), true);
			           
					String res = json.getString(KEY_SUCCESS); 
					if(Integer.parseInt(res) == 1){
						// user successfully registred
						// Store user details in SQLite Database
						DatabaseHandler db = new DatabaseHandler(getApplicationContext());
						JSONObject json_user = json.getJSONObject("user");
						
						// Clear all previous data in database
						userFunction.logoutUser(getApplicationContext());
						db.addUser(json_user.getString(KEY_NAME), json_user.getString(KEY_PHONE), json_user.getString(KEY_ADDRESS), json_user.getString(KEY_EMAIL), json_user.getString(KEY_USERNAME), json_user.getString(KEY_AGE), json_user.getString(KEY_SEX), json_user.getString(KEY_WEIGHT));						
						registration = true;
					}
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}
		    }

			return null;
		}

		@Override
		protected void onPostExecute(Void result) {
			super.onPostExecute(result);
			// Dismiss the progress dialog
			if (pDialog.isShowing())
				pDialog.dismiss();
			
			// Launch Login Screen
			if(registration){
				registration = false;
				Intent login = new Intent(getApplicationContext(), Care24Activity.class);
				login.putExtra("signup", "Successfully Signed Up. Please Login...");
				// Close all views before launching Login
				login.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(login);
				// Close Registration Screen
				finish();
			}
			else{
				// Error in registration
				try {
					if(json.getString(KEY_ERROR_MSG) != null)
						Toast.makeText(SignUpActivity.this, "" + json.getString(KEY_ERROR_MSG), Toast.LENGTH_LONG).show();
					else 
						Toast.makeText(SignUpActivity.this, "Registration Unsuccessful", Toast.LENGTH_LONG).show();
					
				} catch (JSONException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
		    }
		}

	}
	
	/**
	 * Receiving push messages
	 * */
	private final BroadcastReceiver mHandleMessageReceiver = new BroadcastReceiver() {
		@Override
		public void onReceive(Context context, Intent intent) {
			String newMessage = intent.getExtras().getString(CommonUtilities.EXTRA_MESSAGE);
			// Waking up mobile if it is sleeping
			WakeLocker.acquire(getApplicationContext());
			
			/**
			 * Take appropriate action on this message
			 * depending upon your app requirement
			 * For now i am just displaying it on the screen
			 * */
			
			// Showing received message
			//lblMessage.append(newMessage + "\n");			
			Toast.makeText(getApplicationContext(), "New Message: " + newMessage, Toast.LENGTH_LONG).show();
			
			// Releasing wake lock
			WakeLocker.release();
		}
	};


	@Override
	protected void onDestroy() {
		// TODO Auto-generated method stub
		try {
			unregisterReceiver(mHandleMessageReceiver);
			GCMRegistrar.onDestroy(this);
		} catch (Exception e) {
			Log.e("UnRegister Receiver Error", "> " + e.getMessage());
		}
		super.onDestroy();
	}
	
	
	
}
