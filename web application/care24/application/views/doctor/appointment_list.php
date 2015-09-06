<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>


<div class=""  style="min-height: 450px">

    <div class="col-md-2">
        <?php //  $this-> load->view('home/home-side-contents')?>
    </div>
    
    <div class="container thm box">
<!--<div class="col-md-2">
        <?php //  $this-> load->view('home/home-side-contents')?>
    </div>-->
    
        <div class="row contents col-md-10" style="text-align: center;  padding: 10px; padding-bottom: 20px; padding-left: 50px;">

            <h3>Select a hospital to see appointment list </h3>
            <br>

              <div class="list-group">
                  <?php
                        foreach ($hospitals as $row) {
                            ?>
                        
                  <a href="<?php echo site_url('appointment_doc/appointment_list_load?h_id='.$row->id); ?>" class="list-group-item" style="color: #339966;"><?php echo $row->h_name;?> </a>
                        <?php }?>
              </div>
           


        </div>
    </div> 
</div>
<?php $this->load->view('includes/footer') ?>
