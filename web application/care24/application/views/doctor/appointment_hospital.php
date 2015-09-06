<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>


<div class=""  style="min-height: 450px">

    
    <div class="col-md-2">
        <?php //  $this-> load->view('home/home-side-contents')?>
    </div>
    <div class="container thm box">
<!--        <div class="col-md-3">
            <?php // $this->load->view('home/home-side-contents') ?>
        </div>-->

        <div class="row contents col-md-10" style="text-align: center;  padding: 10px; padding-bottom: 20px; padding-left: 50px;">

            <h3>Select a patient to prescribe him </h3>
            <br>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Appointment List</div>
                
                <!-- Table -->
                <table class="table Bordered table">
                    <thead >
                        <tr style="padding-left: 80px;">
                            <th >#</th>
                            
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Appointment Date(YYYY/MM/DD)</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                         $i=1;
                        foreach ($appointments as $row) {
                            ?>
                        
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><a href="<?php echo site_url('appointment_doc/prescribe?u_id='.$row->u_id.'&h_id='.$_GET["h_id"]); ?>"><?php echo $row->name;?></a></td>
                            <td><?php echo $row->age;?></td>
                            <td><?php echo $row->sex;?></td>
                            <td><?php echo $row->date;?></td>
                             <td><?php echo $row->time;?></td>
                        </tr>
                        
                        <?php $i++; }?>
                        
                </table>
            </div>





        </div>
    </div> 
</div>
<?php $this->load->view('includes/footer') ?>
