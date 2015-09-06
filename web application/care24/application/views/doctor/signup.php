<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<?php $this-> load->view('includes/search')?>

<div class="row" style="padding: 10px 10px 10px 10px;">
</div>
<div>    
        <div class="container thm box">
            
<!--    <div class="col-md-3">
        <?php //  $this-> load->view('home/home-side-contents')?>
    </div>-->
<div class="row">
    <div class="col-md-3">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>
    <div class="col-md-9">
    <?php echo validation_errors(); if(isset ($msg) )echo $msg; ?>
    <div id="Create">


        <?php
        echo form_open('register_doctor/insert_doctor');
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
            <label>Pen No*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Pen No" name="pen_no">
              </div>
         <div class="form-group col-md-9">
            </div>
	
         </br>
           
              <div class="form-group col-md-4">
            <label>Specialist*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Specialist" name="specialist">
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
             <legend>Degrees Gained</legend>
             <div id="degree_1">
             <div class="form-group col-md-4">';
            <label> Name* </label>
            <input type="text" class=" form-control search-bar-size" placeholder="Degree Name" name="degree_name1">
              </div>
           <div class="form-group col-md-9">
            </div>
	
            </br>
             <div class="form-group col-md-4">
           <label>Institute*</label>
            <input type="text" class=" form-control search-bar-size" placeholder="Institute" name="institute1">
              </div>
            
            </br>
             <div class="form-group col-md-9">
            </div>
            </div>
	
          <div class="control-group col-md-9" >
            <div class="controls">
              <p class="btn btn-info btn-primary" id="adddegree" onclick="add_degree()">Add Another Degree</p>
              <p class="btn btn-inverse btn-primary" id="removedegree" onclick="remove_degree()">Remove Degree</p>
            </div>
        </div>
             <div class="form-group col-md-9">
            </div>
	
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
<!--?php $this->load->view('doctor/signup_javascript')?-->
<?php $this->load->view('includes/footer') ?>
