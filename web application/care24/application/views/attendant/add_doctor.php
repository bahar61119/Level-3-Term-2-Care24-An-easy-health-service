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

                    <?php
                    if (isset($records)) {
                        foreach ($records as $row) {
                            $results[] = $row;
                            if ($row->name) {
                                ?>
                    <div class="media-body">
                         <a class="pull-left" href="#">
                            <img class="media-object" data-src="holder.js/64x64" alt="...">
                        </a>
                       </br>
                       </br>
                       </br>
                       </br>
                                
                                    <a href="<?php echo base_url(); ?>index.php/<?php echo $row->id; ?>">
                                        <?php echo $row->name; ?>

                                    </a>

                                
                                </div>
                    
                                <?php echo $row->specialist; ?>
                    </br>
                                <?php echo $row->email; ?>
                    </br>
                                <?php echo $row->phone_no; ?>
                    </br>
                                <?php echo $row->address; ?>
                    </br>

                                <div class="form-actions">
                                    <form id="validate-1" class="form-horizontal"  action="<?php echo base_url(); ?>index.php/doctor_list/insert_doctor/<?php echo $row->id; ?>" method="post" >
                                        <button type="submit" class="col-md-2 btn btn btn-success add-bar-size">Add</button>
                                    </form>
                                </div>
                                
                   <div class="col-md-11"></div></br></br>
                            <?php
                            }
                             
                        }
                    }
                    ?>

                </ul>
                </th>
                </tr>


                </tbody>


            </div>
        </div>

<?php $this->load->view('includes/footer') ?>
