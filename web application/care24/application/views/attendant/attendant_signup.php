<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<?php $this-> load->view('includes/search')?>
 
<div class="row" style="padding: 10px 10px 10px 10px;">
</div>
<div>    
        <div class="container thm box">
<div class="row">
    <div class="col-md-3">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>
    <div class="col-md-9">
    <?php echo validation_errors(); if(isset ($msg) )echo $msg; ?>
    <div id="Create">


        <?php
        echo form_open('register_attendant/insert_attendant');
        ?>
        <div class="row-fluid">
            <div class="span4"></div>
                <div class="span5">

        <fieldset>
            <legend>Complete Your Registration</legend>
              <div class="form-group col-md-4">
            <label>Name*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Name" name="name">
              </div>
            <div class="form-group col-md-9">
            </div>
	 </br>
         <div class="form-group col-md-4">
            <label>Username*</label>
                        
            <input type="text" class=" form-control search-bar-size" placeholder="Username" name="username">
         </div>
        <div class="form-group col-md-9">
            </div>
	
         </br>
              <div class="form-group col-md-4">
	            <label>Password*</label>
            <input type="password" class=" form-control search-bar-size" placeholder="Password" name="password">
              </div> 
         <div class="form-group col-md-9">
            </div>
	
         </br>
              <div class="form-group col-md-4">
            <label>Confirm Password*</label>
            <input type="password"  class=" form-control search-bar-size" placeholder="Password" name="confirm_password">
              </div>
         <div class="form-group col-md-9">
            </div>
	
         </br>
              <div class="form-group col-md-4">
            <label>Post*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Current Post" name="post">
              </div>
         <div class="form-group col-md-9">
            </div>
	
         </br>
            <legend>Hospital Information</legend>
              <div class="form-group col-md-4">
            <label>Hospital Name*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Hospital Name" name="h_name">
              </div>
         <div class="form-group col-md-9">
            </div>
	
            </br>
              <div class="form-group col-md-4">
            <label>Address* </label>
            <input type="text" class=" form-control search-bar-size" placeholder="Address" name="address">
              </div>
            </br>
            <div class="form-group col-md-9">
            </div>
	<div class="form-group col-md-5">
            <label>Details*</label>
            <textarea rows="6" cols="30" name="details" placeholder="Give details about hospital here"> </textarea>
        </div> 
            </br>
            <div class="form-group col-md-9">
            </div>
	
             <div class="form-group col-md-4">
            <label>Phone No*</label>
            <input type="text" class=" form-control search-bar-size"  placeholder="Phone No" name="phone_no">
               </div>
            <div class="form-group col-md-9">
            </div>
	
             </br>
         <div class="form-group col-md-4">
            <label>Email*</label>
            <input type="email" class=" form-control search-bar-size" placeholder="Email" name="email">
	 </div>
            <div class="form-group col-md-9">
            </div>
	
             </br>
              <div class="form-group col-md-4">
            <label> Website* </label>
            <input type="text" class=" form-control search-bar-size" placeholder="Website" name="website">
              </div>
           <div class="form-group col-md-9">
            </div>
	
             </br>
              <div class="form-group col-md-4">
            <label>Fax No*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Fax No" name="fax_no">
              </div>
            <div class="form-group col-md-9">
            </div>
	
             </br>
              <div class="form-group col-md-4">
            <label>Emergency No*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Emergency No" name="emergency_no">
              </div>		
		<div class="form-group col-md-9">
            </div>
		
            <br/>
			

        </fieldset>
         <input type="submit" class ="btn btn-success" value="Create" />
          <?php echo form_close(); ?>
         </div>
             <div class="span3"></div>

        </div>

  
</div>
</div>
    </div>
            </div>
                   </div>
<?php $this->load->view('includes/footer') ?>
