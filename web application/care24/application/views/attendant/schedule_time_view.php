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
        echo form_open('schedule_time/insert_doctor_schedule?d_id='.$_GET["d_id"].'&d_name='.$_GET["d_name"]);
        ?>
        <div class="row-fluid">
            <div class="span4"></div>
                <div class="span5">

        <fieldset>
            <div id="schedule_1">
            <legend>Add Schedule of <?php echo $_GET["d_name"] ?>  </legend>
              <div class="form-group col-md-4">
            <label>Day</label>
            <select name="day1" style="width:130px;">

                 <option value= "Sat" >
                     <?php echo "Sat"; ?></option>

                <option value= "Sun" >
                     <?php echo "Sun"; ?></option>

                <option value= "Mon" >
                     <?php echo "Mon"; ?></option>

                 <option value= "Tue" >
                     <?php echo "Tue"; ?></option>

                <option value= "Wed" >
                     <?php echo "Wed"; ?></option>

                <option value= "Thu" >
                     <?php echo "Thu"; ?></option>
                <option value= "Fri" >
                     <?php echo "Fri"; ?></option>
                                  
            </select>
              </div>
            <div class="form-group col-md-11">
            </div>
	 </br>
         
         </br>
                
            <label>Start Time</label>
            <select name="start_time_1" style="width:130px;">

                 <option value= "1" >
                     <?php echo "1"; ?></option>

                <option value= "2" >
                     <?php echo "2"; ?></option>

                <option value= "3" >
                     <?php echo "3"; ?></option>

                 <option value= "4" >
                     <?php echo "4"; ?></option>

                <option value= "5" >
                     <?php echo "5"; ?></option>

                <option value= "6" >
                     <?php echo "6"; ?></option>
                 <option value= "7" >
                     <?php echo "7"; ?></option>

                <option value= "8" >
                     <?php echo "8"; ?></option>

                <option value= "9" >
                     <?php echo "9"; ?></option>

                 <option value= "10" >
                     <?php echo "10"; ?></option>

                <option value= "11" >
                     <?php echo "11"; ?></option>

                <option value= "12" >
                     <?php echo "12"; ?></option>
                                  
            </select>
             <select name="ts1" style="width:130px;">

                 <option value= "am" >
                     <?php echo "am"; ?></option>

                <option value= "pm" >
                     <?php echo "pm"; ?></option>
            </select>
            <label>Finish Time</label>
            <select name="finish_time_1"  style="width:130px;">

                 <option value= "1" >
                     <?php echo "1"; ?></option>

                <option value= "2" >
                     <?php echo "2"; ?></option>

                <option value= "3" >
                     <?php echo "3"; ?></option>

                 <option value= "4" >
                     <?php echo "4"; ?></option>

                <option value= "5" >
                     <?php echo "5"; ?></option>

                <option value= "6" >
                     <?php echo "6"; ?></option>
                 <option value= "7" >
                     <?php echo "7"; ?></option>

                <option value= "8" >
                     <?php echo "8"; ?></option>

                <option value= "9" >
                     <?php echo "9"; ?></option>

                 <option value= "10" >
                     <?php echo "10"; ?></option>

                <option value= "11" >
                     <?php echo "11"; ?></option>

                <option value= "12" >
                     <?php echo "12"; ?></option>
                                  
            </select>
            <select name="tf2" style="width:130px;">

                 <option value= "am" >
                     <?php echo "am"; ?></option>

                <option value= "pm" >
                     <?php echo "pm"; ?></option>
            </select>
            
              </div>
         
            </div>
            <div class="col-md-9" ></div>
          <div class="control-group col-md-9" >
            <div class="controls">
              <p class="btn btn-info btn-primary" id="adddegree" onclick="add_schedule()">Add Another Schedule</p>
              <p class="btn btn-inverse btn-primary" id="removedegree" onclick="remove_schedule()">Remove Schedule</p>
            </div>
        </div>
            
        </fieldset>
            </br>             </br>       
            </br>       
      
         <input type="submit" class ="btn btn-success col-md-offset-4 col-md-3" value="Create" />
          <?php echo form_close(); ?>
         </div>
             <div class="span3"></div>

        </div>

  
</div>
</div>
    </div>
            </div>
                   
<?php $this->load->view('attendant/schedule_javascript')?>
<?php $this->load->view('includes/footer') ?>
