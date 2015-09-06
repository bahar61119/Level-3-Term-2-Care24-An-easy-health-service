package com.care24.care24;

import java.io.File;
import java.io.IOException;
import java.util.List;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.os.StrictMode;
import android.util.Log;

import com.care24.care24.downloader.Downloader;
import com.care24.care24.javaclass.CommonUtilities;

//import com.care24.care24.downloader.Downloader;

public class PDFFromServerActivity extends Activity{
	private String pdf= null;
	 @Override
	    public void onCreate(Bundle savedInstanceState) {
	        super.onCreate(savedInstanceState);
	        setContentView(R.layout.main);
	        pdf = this.getIntent().getStringExtra("pdf");
	        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
	        StrictMode.setThreadPolicy(policy);
	        File extStorageDirectory = android.os.Environment.getExternalStorageDirectory();
	        Log.d("directory", extStorageDirectory.toString());
	        File folder = new File(extStorageDirectory.getAbsolutePath(), "pdf");
	        folder.mkdir();
	        File file = new File(folder, "Read.pdf");
	        try {
	            file.createNewFile();
	        } catch (IOException e1) {
	            e1.printStackTrace();
	        }
	        Downloader.DownloadFile(""+CommonUtilities.SERVER_URL+"/care24/uploads/"+pdf, file);

	        showPdf();
	    }
	    public void showPdf()
	        {
	            File file = new File("mnt/sdcard/pdf/Read.pdf");
	            PackageManager packageManager = getPackageManager();
	            Intent testIntent = new Intent(Intent.ACTION_VIEW);
	            testIntent.setType("application/pdf");
	            List list = packageManager.queryIntentActivities(testIntent, PackageManager.MATCH_DEFAULT_ONLY);
	            Intent intent = new Intent();
	            intent.setAction(Intent.ACTION_VIEW);
	            Uri uri = Uri.fromFile(file);
	            intent.setDataAndType(uri, "application/pdf");
	            startActivity(intent);
	        }
	   
	}

