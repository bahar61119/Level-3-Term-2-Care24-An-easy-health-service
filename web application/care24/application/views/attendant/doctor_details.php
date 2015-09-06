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
                    <h3 style="text-align: center;"><strong>Doctors List</strong></h3>
                    <hr/>
                    <div>
                    </div>
                    </br>
                    </br></br></br>

                    <tbody>
                        <tr>

                    <ul>
<div class="col-md-offset-4 col-md-4">
                        <?php
                        if (isset($doc_records)) {

                            foreach ($doc_records as $row) {
                                $results[] = $row;
                                if ($row->name) {
                                    $d_name=$row->name;
                                    ?>
                                    <div class="media-body">
                                        <a class="pull-left" href="#">
                                            <img class="media-object" data-src="holder.js/64x64" alt="...">
                                        </a>
                                        </br>
                                        </br>
                                        </br>
                                        </br>

                                        <a href="<?php echo base_url(); ?>index.php/doctor_profile/profile/<?php echo $row->name; ?>">
                                            <?php echo $row->name; ?>

                                        </a>


                                    </div>
                                <?php }
                            }
                        } ?>
</div>
                        <div class="col-md-offset-4 col-md-4">
                        <?php
                        if (isset($records)) {

                            foreach ($records as $row) {
                                $results[] = $row;
                                if ($row->doctor_name) {
                                    ?>



                                    <?php echo $row->degree_name; ?>
                                    ,
                                    <?php echo $row->institute; ?>
                                    <br>

                                    <?php
                                }
                            }
                        }
                        ?>
                                    
                                    <br>
                        <div class="form-actions">
                            <form id="validate-1" class="form-horizontal" 
                            action="<?php echo site_url('schedule_time/doctor_schedule?d_id='.$_GET["d_id"].'&d_name='.$d_name); ?>" method="post" >

                                <button type="submit" class="btn btn btn-success col-md-7">Schedule Time</button>
                            </form>
                        </div>
                                    <br>
                        <div class="col-md-11"></div><br>
                        <div class="col-md-offset-1"></div>

                        <div class="form-actions">
                            <form id="validate-1" class="form-horizontal"  
                          action="<?php echo site_url('schedule_appointment/appointment_request_list?d_id='.$_GET["d_id"].'&d_name='.$d_name); ?>" method="post" >
                                <button type="submit" class="btn btn btn-success col-md-7">Show Requests</button>
                            </form>
                        </div>
                        <br>
                        <div class="col-md-11"></div><br>
                        <div class="col-md-offset-1"></div>

                        <div class="form-actions">
                            <form id="validate-1" class="form-horizontal"  
                                  action="<?php echo site_url('schedule_appointment/approved_appointment_list?d_id='.$_GET["d_id"].'&d_name='.$d_name); ?>" method="post" >
                                <button type="submit" class="btn btn btn-success col-md-7">Show Appointments</button>
                            </form>
                        </div>
                        <br>
                        <div class="col-md-11"></div><br>
                        <div class="col-md-offset-1"></div>
                        <div class="form-actions">
                            <form id="validate-1" class="form-horizontal" 
                                  action="<?php echo base_url(); ?>index.php/<?php ?>" method="post" >
                                <button type="submit" class="btn btn btn-success col-md-7">Remove</button>
                            </form>
                        </div>

</div>
                    </ul>
                    </th>
                    </tr>


                    </tbody>


                </div>
            </div>

            <?php $this->load->view('includes/footer') ?>
