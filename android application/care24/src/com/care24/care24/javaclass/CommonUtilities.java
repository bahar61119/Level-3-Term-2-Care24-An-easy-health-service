package com.care24.care24.javaclass;

import android.content.Context;
import android.content.Intent;

public final class CommonUtilities {
	
	// give your server registration url here
    public static final String SERVER_URL = "http://192.168.0.100"; 

    // Google project id
    public static final String SENDER_ID = "202801209396"; 

    /**
     * Tag used on log messages.
     */
    static final String TAG = "Care24 GCM";
    public static boolean IS_GCM_REGSTRATION = false;
    public static String GCM_REGSTRATION_ID;

    public static final String DISPLAY_MESSAGE_ACTION =
            "com.care24.care24.javaclass.DISPLAY_MESSAGE";

    public static final String EXTRA_MESSAGE = "message";
    
    public static String KEY_SUCCESS = "success";
	public static String KEY_ERROR = "error";
	public static String KEY_ERROR_MSG = "error_msg";

    /**
     * Notifies UI to display a message.
     * <p>
     * This method is defined in the common helper because it's used both by
     * the UI and the background service.
     *
     * @param context application's context.
     * @param message message to be displayed.
     */
    public static void displayMessage(Context context, String message) {
        Intent intent = new Intent(DISPLAY_MESSAGE_ACTION);
        intent.putExtra(EXTRA_MESSAGE, message);
        context.sendBroadcast(intent);
    }
}
