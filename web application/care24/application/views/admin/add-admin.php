
<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<div class="color" ></div>
<div class="contents">
<div class="container thm box">

<div class="row web-font-color" style="padding: 10px 10px 10px 10px;">
    <hr/>
    <h3 style="text-align: center;" class="web-font-color"><strong>Create Admin</strong></h3>
    <hr/>
<?php
//
//    echo '<p style="text-align: center;" class="web-font-color">';
//    echo validation_errors();
//    echo '</strong></p>';
    $attributes = array('class' => 'form-horizontal', 'role' => 'form');
    echo form_open('admin_con/add_admin', $attributes);
?>
    
    <p style="text-align: center;" class="web-font-color"><strong><?php 
    if($Error!=null)
    {
        echo $Error;
    }

    ?></strong></p>
    
    
  <div class="form-group">
     
    <label class="col-sm-2 col-sm-offset-2 control-label">First Name</label>
    <div class="col-sm-4">
        <input type="text" name="first_name" class="form-control" data-validation="required length" 
               data-validation-length="4-50" data-validation-error-msg="Between 4-50 chars, only Letter" placeholder="First name">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 col-sm-offset-2 control-label">Last Name</label>
    <div class="col-sm-4">
      <input type="text" name="last_name" class="form-control" data-validation="required length custom" 
             data-validation-length="4-50" data-validation-error-msg="Between 4-50 chars, only Letter" placeholder="Last name">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 col-sm-offset-2 control-label">Username</label>
    <div class="col-sm-4">
      <input type="text" name="username" class="form-control" required="" data-validation="required length alphanumeric" data-validation-length="4-100"
             data-validation-error-msg="Between 3-12 chars, only Alphanumeric" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-sm-2 col-sm-offset-2 control-label">Password</label>
    <div class="col-sm-4">
        <input  name="password" type="password" required="" class="form-control" data-validation="required strength length" 
               data-validation-strength="2" data-validation-length="min8" data-validation-error-msg="Password should be minimum 8 characters" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label  class="col-sm-2 col-sm-offset-2 control-label">Confirm Password</label>
    <div class="col-sm-4">
        <input  type="password" name="con_password" class="form-control" required="" data-validation="confirmation" placeholder="Confirm Password">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 col-sm-offset-2 control-label">Email</label>
    <div class="col-sm-4">
      <input type="email" name="email" class="form-control" required="" data-validation="email" 
              data-validation-error-msg="Please enter email address" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 col-sm-offset-2 control-label">Phone</label>
    <div class="col-sm-4">
      <input type="text" name="phone" class="form-control" data-validation="number length" 
             data-validation-length="3-30" data-validation-error-msg="Please enter phone number" placeholder="Phone">
    </div>
  </div>
     <div class="form-group">
    <label class="col-sm-2 col-sm-offset-2 control-label">Role</label>
    <div class="col-sm-4">
     <div class="radio col-sm-4">
         <label>
          <input type="radio"  name="role" id="admin" value="admin" checked>
          Admin
        </label>
     </div>
        <div class="radio col-sm-4">
         <label>
          <input type="radio" name="role" id="user" value="user">
          User
        </label>
     </div>
    </div>
    
  </div>
  <div class="form-group">
    <label class="col-sm-2 col-sm-offset-2 control-label">Address</label>
    <div class="col-sm-4">
        <textarea type="text" name="address" class="form-control" data-validation="required"data-validation-error-msg="Address is required" placeholder="Address"></textarea>
    </div>
  </div>
   
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <button type="submit" class="btn btn-info btn-block ">Add Admin</button>
    </div>
  </div>
<?php echo form_close(); ?>

    

    
</div>  
    

</div> 
</div> 
<?php $this->load->view('includes/footer')?>
