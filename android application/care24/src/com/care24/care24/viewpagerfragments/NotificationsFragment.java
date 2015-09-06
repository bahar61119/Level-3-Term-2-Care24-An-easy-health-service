package com.care24.care24.viewpagerfragments;

import java.security.Timestamp;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.ListFragment;
import android.text.format.Time;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListAdapter;
import android.widget.SimpleAdapter;
import android.widget.TextView;
import android.widget.Toast;

import com.care24.care24.HospitalListActivity;
import com.care24.care24.R;
import com.care24.care24.javaclass.CommonUtilities;
import com.care24.care24.javaclass.DatabaseHandler;
import com.care24.care24.javaclass.UserFunctions;
import com.care24.care24.javaclass.WakeLocker;

public class NotificationsFragment extends ListFragment{
	
	List<HashMap<String, String> > push_notification = new ArrayList< HashMap<String, String> >();
	ArrayList<String> push = new ArrayList<String>();

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		View rootView = inflater.inflate(R.layout.vp_notifications_fragment, container, false);
		
		getActivity().registerReceiver(mHandleMessageReceiver, new IntentFilter(CommonUtilities.DISPLAY_MESSAGE_ACTION));
		
		
		getNotification();
		
		/*ListAdapter adapter = new SimpleAdapter(
	                getActivity(), push_notification,
	                R.layout.row_items_notification, new String[] { DatabaseHandler.KEY_PUSH_TITLE, DatabaseHandler.KEY_PUSH_MESSAGE,
	                	DatabaseHandler.KEY_PUSH_TIME}, new int[] { R.id.tvNotificationTitle,
	                        R.id.tvNotificationSub, R.id.tvNotificationTime});
		setListAdapter(adapter);
		*/
		setListAdapter(new MyAdapter<String>(getActivity(),android.R.layout.simple_list_item_1,R.id.tvNotificationTitle,push));
		
		
		return rootView;
	}
	
	@Override
	public void onDestroyView() {
		// TODO Auto-generated method stub
		try {
			getActivity().unregisterReceiver(mHandleMessageReceiver);
		} catch (Exception e) {
			Log.e("UnRegister Receiver Error", "> " + e.getMessage());
		}
		super.onDestroyView();
	}

	public void getNotification(){

		DatabaseHandler db = new DatabaseHandler(getActivity().getApplicationContext());
		push_notification =  db.getPushMessages();
		
		for(int i=0;i<push_notification.size();i++){
			push.add(push_notification.get(i).get(DatabaseHandler.KEY_PUSH_TITLE));
			long time = Long.parseLong(push_notification.get(i).get(DatabaseHandler.KEY_PUSH_TIME));
			//Log.d("push list: ",push_notification.get(i).get(DatabaseHandler.KEY_PUSH_TIME));
			Date date = new Date(time);
			push_notification.get(i).put(DatabaseHandler.KEY_PUSH_TIME, date.toString());
		}
		
	}
	
	@SuppressWarnings("hiding")
	private class MyAdapter<String> extends ArrayAdapter<String>{

		public MyAdapter(Context context, int resource, int textViewResourceId,
				ArrayList<String> push) {
			super(context, resource, textViewResourceId, push);
			// TODO Auto-generated constructor stub
		}
		
		@Override
		public View getView(int position, View convertView, ViewGroup parent) {
			// TODO Auto-generated method stub
			LayoutInflater inflater = (LayoutInflater) getActivity().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
			View row = inflater.inflate(R.layout.row_items_notification, parent, false);
			@SuppressWarnings("unchecked")
			
			ImageView iv = (ImageView) row.findViewById(R.id.ivNotificationTitle);
			TextView tvtitle = (TextView) row.findViewById(R.id.tvNotificationTitle);
			TextView tvsub = (TextView) row.findViewById(R.id.tvNotificationSub);
			TextView tvtime = (TextView) row.findViewById(R.id.tvNotificationTime);
			
			tvtitle.setText((CharSequence) "Notifications");//push_notification.get(position).get(DatabaseHandler.KEY_PUSH_TITLE));
			tvsub.setText((CharSequence) push_notification.get(position).get(DatabaseHandler.KEY_PUSH_MESSAGE));
			tvtime.setText((CharSequence) push_notification.get(position).get(DatabaseHandler.KEY_PUSH_TIME));
			
			
			iv.setImageResource(R.drawable.ic_action_new_event);
			
			
			
			return row;
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
			WakeLocker.acquire(getActivity().getApplicationContext());
			
			/**
			 * Take appropriate action on this message
			 * depending upon your app requirement
			 * For now i am just displaying it on the screen
			 * */
			
			// Showing received message
			//lblMessage.append(newMessage + "\n");			
			Toast.makeText(getActivity().getApplicationContext(), "New Message: " + newMessage, Toast.LENGTH_LONG).show();
			
			// Releasing wake lock
			WakeLocker.release();
		}
	};

	

}
