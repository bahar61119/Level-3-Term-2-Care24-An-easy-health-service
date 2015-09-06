<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>
<div class="contents"  style="min-height: 450px">
    
    
    <div class="col-md-2">
        <?php //  $this-> load->view('home/home-side-contents')?>
    </div>
    
    <div class="container thm box">
        
<!--        <div class="col-md-3">
            <?php // $this->load->view('home/home-side-contents') ?>
        </div>-->


        <div class="row contents col-md-10" style="text-align: center; padding: 10px; padding-bottom: 20px;">




            <div>    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs box">
                    <li><a href="#patient_profile"  data-toggle="tab" class="web-font-color"><strong>Patient Profile</strong></a></li>
                    <li><a href="#prescribe" data-toggle="tab" class="web-font-color"><strong>Prescribe</strong></a></li>
                    <li><a href="#previous_prescriptions" data-toggle="tab" class="web-font-color"><strong>Previous Prescriptions</strong></a></li>
                    <li><a href="#previous_reports" data-toggle="tab" class="web-font-color"><strong>Previous Reports</strong></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="padding-top: 10px;">
                    <div class="tab-pane fade in active" id="patient_profile">
                        <div>
                            <?php
                            foreach ($users as $row) {
                                ?>

                                <span class="glyphicon glyphicon-user icon-large" style="font-size: 100px;"></span>
                                <br>
                                <br>
                                <br>
                                <label>
                                    Name:  <?php echo $row->name; ?>
                                </label>    
                                <br>
                                <label>
                                    Email: <?php echo $row->email; ?>
                                </label>    
                                <br>
                                <label>
                                    Age: <?php echo $row->age; ?>
                                </label>    
                                <br>
                                <label>
                                    Weight: <?php echo $row->weight; ?>
                                </label>    
                                <br>
                                <label>
                                    Gender: <?php echo $row->sex; ?>
                                </label>    
                                <br>
                                <label>
                                    <?php echo $row->phone; ?>
                                </label>    
                                <br>
                                <label>
                                    <?php echo $row->address; ?>
                                </label>

                            <?php } ?>
                        </div>

                    </div>
                    <div  class="tab-pane fade col-md-9 col-md-offset-1 " id="prescribe">

                        <?php
                        echo form_open('doctor_con/prescribe?u_id=' . $_GET["u_id"] . '&h_id=' . $_GET["h_id"]);
                        ?>



                        <h2>Prescription Form</h2><br>
                        <div class="input-group-addon" id="fooBar" class="media">


                            <div class="input-group">

                                <span class="input-group-addon">Disease Name</span>
                                <input name="name" style="width:150px;" required=""  type="text" class="form-control" placeholder="Disease name...">

                                <span class="input-group-addon">Details</span>
                                <input style="width:250px;" required="" type="text" name="details" class="form-control" placeholder="Type the details of disease here...">

                            </div>
                            <br>
                            <div class="input-group">

                                <span class="input-group-addon">Suggestions</span>
                                <input style="width:480px;" required="" type="text" name="suggestion" class="form-control" placeholder="Give suggestions to the patient...">
                            </div>           
                            <br>
                            <label for="exampleInputPassword1">Medicines</label>
                            <br><br>

                            <div class="input-group">
                                <span class="input-group-addon">Medicine Name</span>
                                <input  autocomplete = "on" name="med1" required="" style="width:200px;" type="text" class="form-control auto" placeholder="Medicine Name">

                                <span class="input-group-addon">Dose</span>
                                <input  autocomplete = "on" type="number" min="0" step="1" pattern="\d+" name="dose1" required="" style="width:200px;" class="form-control auto" placeholder="Total dose quantity">


                            </div>
                            <br>   
                            <div class="input-group">
                                <span class="input-group-addon">Regulation: </span>
                                <span class="input-group-addon">

                                    <input name="reg11" style="width:30px;" type="checkbox">

                                    <label>Morning</label>
                                    <input name="reg21" type="checkbox" text="morning">

                                    <label>Noon</label>

                                    <input name="reg31" type="checkbox" text="morning">

                                    <label>Night</label>
                                </span>
                                <div class="btn-group">
                                    <span class="input-group-addon">
                                        <label>Dose Time</label>

                                        <select class="btn-group" name="dosetime1" id="cat" class="postform">
                                            <option value="After Meal">After Meal</option>
                                            <option class="level-0" value="Before Meal">Before Meal</option>
                                        </select>

                                    </span>
                                </div>
                            </div>




                            <br>
                        </div>
                        <div>
                            <br>
                            <input class="btn btn-success" value="Add Medicine" onclick="add('textbox')"/>

                            <input style="visibility: hidden;" class="btn btn-danger" id="rmv" value="Remove Medicine" onclick="remove()"/>
                            <br><br>

                            <!--<a  type="submit" class="btn btn-success" id ="habi">Submit</a>-->

                            <span id="foBar">&nbsp;</span>
                            <br>
                        </div>
                        <input type="submit" class ="btn btn-success col-md-offset-4 col-md-3" value="Prescribe" />

                        <?php echo form_close(); ?>
                    </div>

                    <div class="tab-pane fade col-md-11 col-md-offset-1" id="previous_prescriptions">
                        <?php
                        $i = 1;
                        foreach ($prescriptions as $row) {
//                            $h_id = $row->h_id;
                            ?>
                            <br><br>
                            <h2>Prescription <?php echo $row->id; ?></h2>

                            <h4>Date: <?php echo $row->date; ?></h4><br>
                            <div class="input-group-addon col-md-offset-1" id="fooBar" class="media" style="text-align: center;">


                                <div class="input-group">

                                    <span class="input-group-addon"><b>Disease Name:</b> <?php echo $row->disease; ?></span>
                                    <span class="input-group-addon"><b>Details: </b><?php echo $row->details; ?></span>

                                </div>
                                <br>
                                <div class="input-group">

                                    <span class="input-group-addon"><b>Suggestions: </b><?php echo $row->suggestion; ?></span>
                                </div>           
                                <br>
                                <div>
                                    <label for="exampleInputPassword1">Medicines</label>
                                    <br><br>
                                    <?php
                                    $i = 1;
                                    foreach ($medicines as $row_med) {
//                            $h_id = $row->h_id;
                                        if ($row->id == $row_med->p_id) {
                                            ?>    
                                            <div class="input-group">
                                                <span class="input-group-addon"><b>Medicine Name:</b><?php echo $row_med->med_name; ?></span>

                                                <span class="input-group-addon"><b>Dose: </b><?php echo $row_med->dose; ?></span>


                                            </div>
                                            <br>   
                                            <div class="input-group">
                                                <span class="input-group-addon">Regulation: </span>
                                                <?php
                                                $reg = $row_med->regulation;
                                                list($morning, $noon, $night) = explode('--', $reg);
//            echo $morning."  ".$noon."  ".$night;
                                                ?>
                                                <span class="input-group-addon">
                                                    <?php
                                                    if ($morning == "1") {
                                                        ?>
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    <?php } ?> 

                                                    <label>Morning</label>

                                                    <?php
                                                    if ($noon == "1") {
                                                        ?>
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    <?php } ?> 

                                                    <label>Noon</label>

                                                    <?php
                                                    if ($night == "1") {
                                                        ?>
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    <?php } ?> 


                                                    <label>Night</label>
                                                </span>
                                                <div class="btn-group">
                                                    <span class="input-group-addon">
                                                        <label><b>Dose Time:</b> <?php echo $row_med->details; ?></label>


                                                    </span>
                                                </div>
                                            </div><br><br>

                                        <?php
                                        }
                                    }
                                    ?>

                                </div>

                                <br>
                            </div><br><br>
                            <?php
                            $i+=1;
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade" id="previous_reports">
                        <!--<div class="row contents col-md-9" style="text-align: center;  padding: 10px; padding-bottom: 20px; padding-left: 50px;">-->

                            <!--<h3>Request List </h3>-->
                            <br>

                            <div class="list-group">
                                <?php
                                $i = 0;
                                foreach ($reports as $row) {
                                    ?>
                                <a  href="<?php echo base_url().'uploads/'.$row->pdf; ?>" target="_blank" class="list-group-item" style="color: #339966;"><?php echo $row->date; ?> </a>
                                    <?php
                                    $i++;
                                }
                                if ($i == 0) {
                                    ?>
                                    <h4>You Have no Hospital Request</h4>
<?php } ?>
                            </div>



                        <!--</div>-->


                    </div>


                </div>
            </div>
        </div>
    </div>


</div> 
</div>
<?php $this->load->view('includes/footer') ?>
