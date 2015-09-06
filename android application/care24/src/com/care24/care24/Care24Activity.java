package com.care24.care24;

import java.util.HashMap;

import org.json.JSONException;
import org.json.JSONObject;

import com.care24.care24.javaclass.AlertDialogManager;
import com.care24.care24.javaclass.ConnectionDetector;
import com.care24.care24.javaclass.DatabaseHandler;
import com.care24.care24.javaclass.UserFunctions;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class Care24Activity extends Activity {

	private EditText etUserName;
	private EditText etPassword;
	private Button btLogin;
	private Button btSignUp;
	private TextView tvSignUp;
	private TextView tvForgetPassword;
	private ProgressDialog pDialog;
	private boolean login;
	private JSONObject json_user;
	
	// Alert dialog manager
    private AlertDialogManager alert = new AlertDialogManager();
    // Connection detector
 	private ConnectionDetector cd;
	
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
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		
	}


	@Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_care24);
        
        if(getIntent().hasExtra("signup"))
        	Toast.makeText(Care24Activity.this, "" + getIntent().getStringExtra("signup"), Toast.LENGTH_LONG).show();
		
        
        login = false;
        etUserName = (EditText) findViewById(R.id.etUsernameLogin);
        etPassword = (EditText) findViewById(R.id.etPasswordLogin);
        btLogin = (Button) findViewById(R.id.btLogin);
        tvSignUp = (TextView)findViewById(R.id.tv_SignUp);
        tvForgetPassword = (TextView)findViewById(R.id.tvForgetPassword);
        
        btLogin.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
				cd = new ConnectionDetector(getApplicationContext());

				// Check if Internet present
				if (!cd.isConnectingToInternet()) {
					// Internet Connection is not present
					alert.showAlertDialog(Care24Activity.this,
							"Internet Connection Error",
							"Please connect to working Internet connection", false);
					// stop executing code by return
					
				}
				else {
					new Login().execute();
					
				}
			}
		});
      
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.care24, menu);
        return true;
    }
    
    public void onClick_SignUp(View v){
        Intent intent = new Intent(Care24Activity.this, SignUpActivity.class);
        startActivity(intent);
        }
    

    public void onClick_ForgotPassword(View v){
        Intent intent = new Intent(Care24Activity.this, ForgetPasswordActivity.class);
        startActivity(intent);
    }
    
    /**
	 * Async task class to get json by making HTTP call
	 * */
	private class Login extends AsyncTask<Void, Void, Void> {

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			// Showing progress dialog
			pDialog = new ProgressDialog(Care24Activity.this);
			pDialog.setMessage("Please wait...");
			pDialog.setCancelable(false);
			pDialog.show();

		}

		@Override
		protected Void doInBackground(Void... arg0) {
			// Creating service handler class instance

			String username = etUserName.getText().toString();
			String password = etPassword.getText().toString();
			UserFunctions  userFunction= new UserFunctions();
			JSONObject json = userFunction.loginUser(username, password);
			
			Log.d("Button", "Login");
			

			// check for login response
			try {
				if (json.getString(KEY_SUCCESS) != null) {
					String res = json.getString(KEY_SUCCESS); 
					if(Integer.parseInt(res) == 1){
						// user successfully logged in
						// Store user details in SQLite Database
						DatabaseHandler db = new DatabaseHandler(getApplicationContext());
						json_user = json.getJSONObject("user");
						
						// Clear all previous data in database
						userFunction.logoutUser(getApplicationContext());
						db.addUser(json_user.getString(KEY_NAME), json_user.getString(KEY_PHONE), json_user.getString(KEY_ADDRESS), json_user.getString(KEY_EMAIL), json_user.getString(KEY_USERNAME), json_user.getString(KEY_AGE), json_user.getString(KEY_SEX), json_user.getString(KEY_WEIGHT));						
						login = true;
						
					}
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}
			//json = userFunction.hospitalInfo();
			//Toast.makeText(getApplicationContext(), ""+json, Toast.LENGTH_LONG).show();
			//Log.d("Hospitals", json.toString());

			return null;
		}

		@Override
		protected void onPostExecute(Void result) {
			super.onPostExecute(result);
			// Dismiss the progress dialog
			if (pDialog.isShowing())
				pDialog.dismiss();
			
			// Launch Login Screen
			if(login){
			
				// Launch Appliaton Screen
				Intent app = new Intent(getApplicationContext(), ViewPagerActivity.class);
					DatabaseHandler db = new DatabaseHandler(getApplicationContext());
					HashMap<String,String> user = db.getUserDetails();
					//Toast.makeText(Care24Activity.this, "Login: " + user.toString(), Toast.LENGTH_LONG).show();
					app.putExtra("name" , user.get("name"));
				app.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(app);
				// Close Login Screen
				finish();
			}
			else{
				// Error in registration
				Toast.makeText(Care24Activity.this, "Login Unsuccessful", Toast.LENGTH_LONG).show();
		    }
		}

	}
    
    
}
