
package com.care24.care24.javaclass;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class DatabaseHandler extends SQLiteOpenHelper {

	// All Static variables
	// Database Version
	private static final int DATABASE_VERSION = 1;

	// Database Name
	private static final String DATABASE_NAME = "care24";

	// Login table name
	private static final String TABLE_LOGIN = "login";
	private static final String TABLE_PUSH = "push";

	// Login Table Columns names
	private static final String KEY_ID = "id";
	private static final String KEY_NAME = "name";
	private static final String KEY_PHONE = "phone";
	private static final String KEY_ADDRESS = "address";
	private static final String KEY_EMAIL = "email";
	private static final String KEY_USERNAME = "username";
	private static final String KEY_AGE = "age";
	private static final String KEY_SEX = "sex";
	private static final String KEY_WEIGHT = "weight";
	private static final String KEY_GCM_REGID = "gcm_regid";
	
	//Push Table Columns names
	public static final String KEY_PUSH_TITLE = "title";
	public static final String KEY_PUSH_MESSAGE = "message";
	public static final String KEY_PUSH_TYPE = "type";
	public static final String KEY_PUSH_TYPE_NEW = "new";
	public static final String KEY_PUSH_TYPE_OLD = "old";
	public static final String KEY_PUSH_TIME = "time";

	public DatabaseHandler(Context context) {
		super(context, DATABASE_NAME, null, DATABASE_VERSION);
	}

	// Creating Tables
	@Override
	public void onCreate(SQLiteDatabase db) {
		
		String CREATE_PUSH_TABLE = "CREATE TABLE " + TABLE_PUSH + "("
				+ KEY_ID + " INTEGER PRIMARY KEY," 
				+ KEY_PUSH_TITLE + " TEXT," 
				+ KEY_PUSH_MESSAGE + " TEXT,"
				+ KEY_PUSH_TIME + " TEXT,"
				+ KEY_PUSH_TYPE + " TEXT" + ")";
		
		String CREATE_LOGIN_TABLE = "CREATE TABLE " + TABLE_LOGIN + "("
				+ KEY_ID + " INTEGER PRIMARY KEY," 
				+ KEY_NAME + " TEXT,"
				+ KEY_PHONE + " TEXT,"
				+ KEY_ADDRESS + " TEXT,"
				+ KEY_EMAIL + " TEXT,"
				+ KEY_USERNAME + " TEXT UNIQUE,"
				+ KEY_AGE + " TEXT,"
				+ KEY_SEX + " TEXT,"
				+ KEY_WEIGHT + " TEXT" + ")";
		

		db.execSQL(CREATE_PUSH_TABLE);
		db.execSQL(CREATE_LOGIN_TABLE);
	
	}
	
	public void createPushTable(){
		SQLiteDatabase db = this.getWritableDatabase();
		String CREATE_PUSH_TABLE = "CREATE TABLE " + TABLE_PUSH + "("
				+ KEY_ID + " INTEGER PRIMARY KEY," 
				+ KEY_PUSH_TITLE + " TEXT," 
				+ KEY_PUSH_MESSAGE + " TEXT,"
				+ KEY_PUSH_TIME + " TEXT,"
				+ KEY_PUSH_TYPE + " TEXT" + ")";
		db.execSQL(CREATE_PUSH_TABLE);
	}

	// Upgrading database
	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		// Drop older table if existed
		db.execSQL("DROP TABLE IF EXISTS " + TABLE_LOGIN);
		db.execSQL("DROP TABLE IF EXISTS " + TABLE_PUSH);

		// Create tables again
		onCreate(db);
	}

	/**
	 * Storing user details in database
	 * */
	public void addUser(String name, String phone, String address, String email, String username, String age, String sex, String weight) {
		SQLiteDatabase db = this.getWritableDatabase();

		ContentValues values = new ContentValues();
		values.put(KEY_NAME, name); // Name
		values.put(KEY_PHONE, phone); // Phone
		values.put(KEY_ADDRESS, address); // Address
		values.put(KEY_EMAIL, email); // Email
		values.put(KEY_USERNAME, username); // Username
		values.put(KEY_AGE, age); // Age
		values.put(KEY_SEX, sex); // Sex
		values.put(KEY_WEIGHT, weight); // Weight

		// Inserting Row
		db.insert(TABLE_LOGIN, null, values);
		db.close(); // Closing database connection
	}
	
	/**
	 * Storing push details in database
	 * */
	public void addPush(String title, String message,String time, String type) {
		SQLiteDatabase db = this.getWritableDatabase();

		ContentValues values = new ContentValues();
		values.put(KEY_PUSH_TITLE, title); // Title
		values.put(KEY_PUSH_MESSAGE, message); // Message
		values.put(KEY_PUSH_TIME, time); // Message
		values.put(KEY_PUSH_TYPE, type); // Type new or old

		// Inserting Row
		db.insert(TABLE_PUSH, null, values);
		db.close(); // Closing database connection
	}
	
	
	/**
	 * Getting user data from database
	 * */
	public HashMap<String, String> getUserDetails(){
		HashMap<String,String> user = new HashMap<String,String>();
		String selectQuery = "SELECT  * FROM " + TABLE_LOGIN;
		 
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        // Move to first row
        
        cursor.moveToFirst();
        if(cursor.getCount() > 0){
        	user.put("name", cursor.getString(1));
        	user.put("phone", cursor.getString(2));
        	user.put("address", cursor.getString(3));
        	user.put("email", cursor.getString(4));
        	user.put("username", cursor.getString(5));
        	user.put("age", cursor.getString(6));
        	user.put("sex", cursor.getString(7));
        	user.put("weight", cursor.getString(8));
        }
        cursor.close();
        db.close();
		// return user
		return user;
	}
	
	/**
	 * Getting push data with type from database
	 * */
	public ArrayList< HashMap<String,String> > getTypePushMessages(String type){
		HashMap<String,String>  push = new  HashMap<String,String>();
		ArrayList< HashMap<String,String> > pushList = new  ArrayList<HashMap<String,String> >();
		
		String selectQuery = "SELECT  * FROM " + TABLE_PUSH + " WHERE = " + type + " ORDER BY "+ KEY_PUSH_TIME + " DESC";
		 
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        
        // looping through all rows and adding to list
	    if (cursor.moveToFirst()) {
	        do {
	        	push.put("id", cursor.getString(0));
	        	push.put("title", cursor.getString(1));
	        	push.put("message", cursor.getString(2));
	        	push.put("time", cursor.getString(3));
	        	push.put("type", cursor.getString(4));
	            // Adding push to list
	            pushList.add(push);
	            push.clear();
	        } while (cursor.moveToNext());
	    }
        
        
        cursor.close();
        db.close();
		// return user
		return pushList;
		
	}
	
	
	/**
	 * Getting all push data from database
	 * */
	public ArrayList< HashMap<String,String> > getPushMessages(){
		
		ArrayList< HashMap<String,String> > pushList = new  ArrayList< HashMap<String,String> >();
		
		String selectQuery = "SELECT  * FROM " + TABLE_PUSH + " ORDER BY "+ KEY_PUSH_TIME + " DESC";
		 
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);
        
        // looping through all rows and adding to list
	    if (cursor.moveToFirst()) {
	        do {
	        	Log.d("Database PUSH",cursor.getString(2));
	        	HashMap<String,String>  push = new  HashMap<String,String>();
	        	push.put("id", cursor.getString(0));
	        	push.put("title", cursor.getString(1));
	        	push.put("message", cursor.getString(2));
	        	push.put("time", cursor.getString(3));
	        	push.put("type", cursor.getString(4));
	            // Adding push to list
	            pushList.add(push);
	            
	            //push.clear();
	        } while (cursor.moveToNext());
	    }
	    
	    Log.d("Database PUSH",pushList.toString());
        
        
        cursor.close();
        db.close();
		// return user
		return pushList;
		
	}
	
	

	/**
	 * Getting user login status
	 * return true if rows are there in table
	 * */
	public int getRowCount() {
		String countQuery = "SELECT  * FROM " + TABLE_LOGIN;
		SQLiteDatabase db = this.getReadableDatabase();
		Cursor cursor = db.rawQuery(countQuery, null);
		int rowCount = cursor.getCount();
		db.close();
		cursor.close();
		
		// return row count
		return rowCount;
	}
	
	/**
	 * Re crate database
	 * Delete all tables and create them again
	 * */
	public void resetTables(){
		SQLiteDatabase db = this.getWritableDatabase();
		// Delete All Rows
		db.delete(TABLE_LOGIN, null, null);
		db.close();
	}
	
	 // Updating push message
    public int updatePushMessage(String id, String type) {
        SQLiteDatabase db = this.getWritableDatabase();
 
        ContentValues values = new ContentValues();
        values.put(KEY_PUSH_TYPE, type);
 
        // updating row
        return db.update(TABLE_PUSH, values, KEY_ID + " = ?",
                new String[] { id });
    }
	
 // Deleting push message with type
 	public void deletePushMessageWithID(String id) {
 	    SQLiteDatabase db = this.getWritableDatabase();
 	    db.delete(TABLE_PUSH, KEY_ID + " = ?",
 	            new String[] { id });
 	    db.close();
 	}
    
    // Deleting push message with type
	public void deletePushMessage(String type) {
	    SQLiteDatabase db = this.getWritableDatabase();
	    db.delete(TABLE_PUSH, KEY_PUSH_TYPE + " = ?",
	            new String[] { type });
	    db.close();
	}
	
	// Deleting push message with type
	public void deletePushMessage() {
		    SQLiteDatabase db = this.getWritableDatabase();
		    db.delete(TABLE_PUSH, null, null);
		    db.close();
		}

}
