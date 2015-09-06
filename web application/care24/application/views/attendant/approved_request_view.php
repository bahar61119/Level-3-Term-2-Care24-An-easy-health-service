<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>


<div class="row" style="padding: 10px 10px 10px 10px;">
</div>
<div>    
    <div class="container thm box">
        <div class="row">
            <div class="col-md-3">
                <?php // $this->load->view('home/home-side-contents') ?>
            </div>
            <div class="col-md-9">




                <div>
                    <h3 style="text-align: center;"><strong>Approved Appointments Request List </strong></h3>
                    <hr/>
                    <div>

                        <?php
                        echo form_open('schedule_appointment/search_approved_appointment');
                        ?>

                        <div class="form-group ">

                            <div class="form-group col-md-4" >
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>     
<?php echo 'Doctor Name' ?>
                                <select name="doctor_name"class=" form-control btn search-bar-size">
                                    <option></option>

                                    <?php
                                    if (isset($drecords)) {
                                        foreach ($drecords as $row) {
                                            $results[] = $row;
                                            if ($row->name) {
                                                ?>
                                                <option value='<?php echo $row->id ?>' ><?php echo $row->name ?></option>
        <?php }
    }
} ?>
                                </select>
                            </div>
                            </br> </br> </br> </br>
                        </div>
                        </br>  
                        <button type="submit" id="search-btn" class="col-md-4 btn btn btn-success search-bar-size">
                            Search Appointments</button>
<?php echo form_close(); ?>


                    </div>
                    </br>
                    </br></br></br></br>

                    <div class="media " >
                         </br></br></br></br></br>
                        <?php
                        if (isset($records)) {
                            foreach ($records as $row) {
                  
                                $results[] = $row;
                                if ($row->adate) {
                                    ?>
                     <div class="">               
                                        <p3 style="text-align: left;"><strong>Date: </strong></p3>
            <?php echo $row->adate; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Problem Description: </strong></p3>
            <?php echo $row->adescription; ?>
                                        </br> 
                                        <p3 style="text-align: left;"><strong>Invoice No: </strong></p3>
            <?php echo $row->ainvoice_no; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Bkash No: </strong></p3>
            <?php echo $row->abkash_no; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Card No: </strong></p3>
            <?php echo $row->acard_no; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Name: </strong></p3>
            <?php echo $row->uname; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Phone: </strong></p3>
            <?php echo $row->uphone; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Address: </strong></p3>
            <?php echo $row->uaddress; ?>
                                        </br> 
                                        <p3 style="text-align: left;"><strong>Email: </strong></p3>
            <?php echo $row->uemail; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Sex: </strong></p3>
            <?php echo $row->usex; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Weight: </strong></p3>
                                        <?php echo $row->uweight; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Age: </strong></p3>
            <?php echo $row->uage; ?>
                                        </br>
            <?php echo"----------------------------------------------------------"; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Doctor Name: </strong></p3>
                                        <p1> <strong>    <?php echo "Dr." . $row->dname; ?></strong></p1>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Specialist: </strong></p3>
                                        <?php echo $row->dspecialist; ?>
                                        </br> 

                                        <p3 style="text-align: left;"><strong>Doctor Email: </strong></p3>
            <?php echo $row->demail; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Doctor Phone No: </strong></p3>
            <?php echo $row->dphone_no; ?>
                                        </br>
                                        <p3 style="text-align: left;"><strong>Doctor Address: </strong></p3>
            <?php echo $row->daddress; ?>
                                        </br>

                                        </br>


                                        <a href="#">
                                            <button type="submit" id="search-btn" class="col-md-2 btn btn btn-success add-bar-size" >Cancel </button></a>
                                       

                                    <hr/>
                                    </div>
                                    </div>
                                    
                                </div>
                            
                        </div>      <?php
        }
    }
}
?>
        </div>   
    </div>
</div>
<?php $this->load->view('includes/footer') ?>
