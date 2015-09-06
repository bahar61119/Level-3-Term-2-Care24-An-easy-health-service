<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<?php $this-> load->view('includes/search')?>
 
<div class="row" style="padding: 10px 10px 10px 10px;">
</div>
<div>    
        <div class="container thm box">
<div class="row">
    <div class="col-md-4">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>
    <div class="col-md-8">
    <?php echo validation_errors(); if(isset ($msg) )echo $msg; ?>
    <div id="Create">


        <?php
        echo form_open('admin_con/authentication');
        ?>
        <div class="row-fluid">
            <div class="span4"></div>
                <div class="span5">

        <fieldset>
            <legend>Sign In</legend>
             <br>
         <div class="form-group col-md-9">
            <label>Username(For Attendant)/Pen Number(For Doctors)*</label>
             
            </div>
	
         <div class="form-group col-md-4">
            <input type="text" class=" form-control search-bar-size" placeholder="Username" name="username" required="">
         </div>
        <div class="form-group col-md-9">
            </div>
	
         <br>
              <div class="form-group col-md-4">
	            <label>Password*</label>
            <input required="" type="password" class=" form-control search-bar-size" placeholder="Password" name="password">
              </div> 
         <div class="form-group col-md-9">
            </div>
	
         <br>
              	

        </fieldset>
                     <div class="form-group col-md-4">
         <input type="submit" class ="btn btn-success" value="Login" />
                     </div>
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
