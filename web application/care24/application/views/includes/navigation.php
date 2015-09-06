 
  <nav class="navbar navbar-fixed-top bs-docs-nav color" role="navigation">
    <div class="container color">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          <div>
            <a href="#"><img class="navsize" src="<?php echo base_url(); ?>assets/img/care24_1.png"></a>
          </div>
          
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav navbar-right">
                    <?php if($this->session->userdata('is_logged_in_doctor')): ?>
                  
                  <!--<li><a href="<?php echo site_url('home_con'); ?>" class="nav-text">Home</a></li>-->
                  

                  <li><a href="<?php echo site_url('home_con/home_doc'); ?>" class="nav-text">Profile</a></li>
                  <li><a href="<?php echo site_url('appointment_doc/appointment_list'); ?>" class="nav-text">Appoinment List</a></li>
                  
                  
                  <li><a href="<?php echo site_url('doctor_con/get_requests');?>" class="nav-text">Requests</a></li>
                  <li><a href="<?php echo site_url('doc_signin_con/signout');?>" class="nav-text">Sign out</a></li>
                  <?php 
                  elseif($this->session->userdata('is_logged_in_attendant')):
                  ?>
                  
                   <li><a href="<?php echo site_url('doctor_list/add_doctor');?>" class="nav-text">Add Doctor</a></li>
                  <li><a href="<?php echo site_url('attendant_con/doctor_list');?>" class="nav-text">Shedule Appointment</a></li>
                  <li><a href="<?php echo site_url('send_reports_con/user_list');?>" class="nav-text">Send Reports</a></li>
<!--                  <li><a href="#" class="nav-text">Add Operator</a></li>
                  <li><a href="#" class="nav-text">Settings</a></li>-->
                  <li><a href="<?php echo site_url('doc_signin_con/signout');?>" class="nav-text">Sign out</a></li>
                 
                  
                  
                   <?php 
                  elseif($this->session->userdata('is_logged_in_admin')):
                  ?>
                  
                   <li><a href="<?php echo site_url('admin_con/admin_profile');?>" class="nav-text">Profile</a></li>
                  <li><a href="<?php echo site_url('admin_con/add_admin');?>" class="nav-text">Add Admin</a></li>
                  <li><a href="<?php echo site_url('admin_con/hospital_list');?>" class="nav-text">Hospitals</a></li>
                  <li><a href="<?php echo site_url('admin_con/doctor_list');?>" class="nav-text">Doctors</a></li>
                  <li><a href="<?php echo site_url('admin_con/request_list');?>" class="nav-text">Requests</a></li>
                  <li><a href="<?php echo site_url('doc_signin_con/signout');?>" class="nav-text">Sign out</a></li>
                 
                  <?php 
                  
                  
                  
                  else:
                  ?>
                  <li><a href="<?php echo site_url('doc_signin_con');?>" class="nav-text">SignIn</a></li>
                  <?php endif;?>  
                </ul>
            
          </div><!-- /.navbar-collapse -->
            </div>
  </nav>