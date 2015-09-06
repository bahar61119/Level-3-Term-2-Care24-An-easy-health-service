package com.care24.care24.adapter;

import com.care24.care24.viewpagerfragments.AboutFragment;
import com.care24.care24.viewpagerfragments.AppointmentsFragment;
import com.care24.care24.viewpagerfragments.MyPrescriptionsFragment;
import com.care24.care24.viewpagerfragments.MyReportsFragment;
import com.care24.care24.viewpagerfragments.NotificationsFragment;
import com.care24.care24.viewpagerfragments.ProfileFragment;
import com.care24.care24.viewpagerfragments.TimelineFragment;
import com.care24.care24.viewpagerfragments.VPMapFragment;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.app.FragmentStatePagerAdapter;

public class TabsPagerAdapter extends FragmentStatePagerAdapter{
	
	private final int FARAGMENT_COUNT = 8;

	public TabsPagerAdapter(FragmentManager fm) {
		super(fm);
		// TODO Auto-generated constructor stub
	}

	@Override
	public Fragment getItem(int arg0) {
		// TODO Auto-generated method stub
		switch(arg0){
			case 0:
				return new VPMapFragment();
			case 1:
				return new NotificationsFragment();
			case 2:
				return new AppointmentsFragment();
			case 3:
				return new MyReportsFragment();
			case 4:
				return new MyPrescriptionsFragment();
			case 5:
				return new TimelineFragment();
			case 6:
				return new ProfileFragment();
			case 7:
				return new AboutFragment();
		}
		
		return null;
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return FARAGMENT_COUNT;
	}

}
