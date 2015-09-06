package com.care24.care24;



import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import com.care24.care24.javaclass.CommonUtilities;
import com.care24.care24.javaclass.DatabaseHandler;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class AppointmentFormActivity extends Activity{

	private TextView text_date;
	private Button dateButton;
//	private static String imagestr;

	// public ArrayList<LatLng> latlong_list;
	//public ArrayList<String> photoPath_List;
	private int year;
	private int month;
	private int day;

//	final static int CAPTURE_IMAGE_ACTIVITY_REQUEST_CODE = 1888;
	//final static int CAMERA_REQUEST = 1888;
	static final int DATE_PICKER_ID = 1111;

	//Uri imageUri = null;
	//static TextView imageDetails = null;
	//public static ImageView showImg = null;
	//Capture_activity CameraActivity = null;

	//private static String Path;
	
	Button requestButton;
	List<NameValuePair> nameValuePair = new ArrayList<NameValuePair>(2);
    

	//int serverResponseCode = 0;
	ProgressDialog dialog = null;
	EditText et_description;
	EditText et_invoice_no;
	EditText et_bkash_card_no;
    String s_description;
    String s_invoice_no;
    String s_bkash_card_no;
    String h_id;
    String d_id;
    HashMap<String,String> user=null;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		final DatabaseHandler db_in=new DatabaseHandler(getApplicationContext());
    	user=db_in.getUserDetails();
    	
		super.onCreate(savedInstanceState);
		setContentView(R.layout.appointment_form_layout);
		//CameraActivity = this;
        h_id = this.getIntent().getStringExtra("h_id");
		d_id= this.getIntent().getStringExtra("id");

		text_date = (TextView) findViewById(R.id.textview_date);
		dateButton = (Button) findViewById(R.id.button_date);
		requestButton = (Button) findViewById(R.id.button_appointment);
		//imageDetails = (TextView) findViewById(R.id.imageDetails);

		//showImg = (ImageView) findViewById(R.id.showImg);

		//final Button photoButton = (Button) findViewById(R.id.photo);

		// Get current date by calender

		final Calendar c = Calendar.getInstance();
		year = c.get(Calendar.YEAR);
		month = c.get(Calendar.MONTH);
		day = c.get(Calendar.DAY_OF_MONTH);

		// Show current date

		text_date.setText(new StringBuilder()
				// Month is 0 based, just add 1
				.append(month + 1).append("-").append(day).append("-")
				.append(year).append(" "));

		// Button listener to show date picker dialog

		dateButton.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {

				// On button click show datepicker dialog
				showDialog(DATE_PICKER_ID);

			}

		});

		requestButton.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {

			//	String duration_string;
				// uploadImage(imagestr);

				
//////////////////////////////////////////////////////////////////////////
				  et_description = (EditText) findViewById(R.id.description);
					et_invoice_no = (EditText) findViewById(R.id.invoice_no);
					//spinner_drainage = (Spinner) findViewById(R.id.spinner1);
					et_bkash_card_no = (EditText) findViewById(R.id.bkash_card_no);
					
					
				new Postdata().execute();

				Toast.makeText(AppointmentFormActivity.this,
						"Appointment Request Submitted Successfully ", Toast.LENGTH_SHORT)
				.show();
				 Intent in = new Intent(getApplicationContext(),
	                        AppointmentFormActivity.class);
				 startActivity(in);
	            
				}	  
			});
	}

	@Override
	protected Dialog onCreateDialog(int id) {
		switch (id) {
		case DATE_PICKER_ID:

			// open datepicker dialog.
			// set date picker for current date
			// add pickerListener listner to date picker
			return new DatePickerDialog(this, pickerListener, year, month, day);
		}
		return null;
	}

	private DatePickerDialog.OnDateSetListener pickerListener = new DatePickerDialog.OnDateSetListener() {

		// when dialog box is closed, below method will be called.
		@Override
		public void onDateSet(DatePicker view, int selectedYear,
				int selectedMonth, int selectedDay) {

			year = selectedYear;
			month = selectedMonth;
			day = selectedDay;

			// Show selected date
			text_date.setText(new StringBuilder().append(month + 1).append("-")
					.append(day).append("-").append(year).append(" "));

		}
	};
	  private class Postdata extends AsyncTask<Void, Void, Void> {

			@Override
			protected Void doInBackground(Void... params) {
			  s_description=et_description.getText().toString();
				s_invoice_no=et_invoice_no.getText().toString();
				s_bkash_card_no=et_bkash_card_no.getText().toString();
				
				/////////////////////////////////////////////////////////
		        HttpClient httpClient = new DefaultHttpClient();
		        // Creating HTTP Post
		        HttpPost httpPost = new HttpPost(
		                ""+CommonUtilities.SERVER_URL+"/api.php/");
		        Log.d("Http Response:",s_description+s_invoice_no+s_bkash_card_no);
		        
		        // Building post parameters
		        // key and value pair
		        nameValuePair.add(new BasicNameValuePair("tag", "appointment_request")); 
		        nameValuePair.add(new BasicNameValuePair("d_id", d_id));
		        nameValuePair.add(new BasicNameValuePair("h_id", h_id));
		        
		        //Toast.makeText(getApplicationContext(), ""+db_in.get("id"), Toast.LENGTH_LONG).show();
		    	nameValuePair.add(new BasicNameValuePair("u_id", "16"));
		        nameValuePair.add(new BasicNameValuePair("description", s_description));
		        nameValuePair.add(new BasicNameValuePair("invoice_no", s_invoice_no));
		        nameValuePair.add(new BasicNameValuePair("bkash_no",s_bkash_card_no));
		        nameValuePair.add(new BasicNameValuePair("date", year + "-"
						+ month + "-" + day));		
		        
		        // Url Encoding the POST parameters
		        try {
		            httpPost.setEntity(new UrlEncodedFormEntity(nameValuePair));
		        } catch (UnsupportedEncodingException e) {
		            // writing error to Log
		            e.printStackTrace();
		        }
		           
		        // Making HTTP Request
		        try {
		        	
		            HttpResponse response = httpClient.execute(httpPost);
		            if (response.getStatusLine().getStatusCode() == 200)
		        	{
		            	 Log.d("Http Response:","all is not well");
		            	Log.d("Http Response:", response.toString());	}
		            // writing response to log
		            
		        } catch (ClientProtocolException e) {
		            // writing exception to log
		            e.printStackTrace();
		        } catch (IOException e) {
		            // writing exception to log
		           e.printStackTrace();
		        }
		        
		        
				return null;
	        
	    }

	  }
}
