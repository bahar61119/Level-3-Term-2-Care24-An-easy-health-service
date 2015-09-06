<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>


<div class=""  style="min-height: 450px">
    

    <div class="col-md-2">
        <?php //  $this-> load->view('home/home-side-contents')?>
    </div>
    
    <div class="container thm box">
<!--<div class="col-md-3">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>-->
    
        <div class="row contents col-md-10" style="text-align: center;  padding: 10px; padding-bottom: 20px; padding-left: 50px;">

            <h3>Hospital Add Requests</h3>
            <br>

              <div class="row">
                  <?php
                  $i=0;
                        foreach ($hospitals as $row) {
                            ?>
                <!--<div style="display: inline;" class="row">-->        <hr>
                  <a style="display: inline; width:100px; text-align: left;"  class="list-group-item" style="color: #339966;"><b><?php echo $row->h_name;?></b> </a>
                                        <a href="<?php echo site_url('doctor_con/accept_request/'.$row->a_id); ?>"><button style="display: inline;text-align: right;" type="submit" class="btn btn btn-success col-lg-offset-1">Accept</button></a>
                                        <a href="<?php echo site_url('doctor_con/cancel_request/'.$row->a_id); ?>"> <button style="display: inline;text-align: right;" type="submit" class="btn btn btn-success col-lg-offset-1">Cancel</button></a>
                                        
                     <!--</div>-->   <hr>
                      <?php $i++; } if($i==0){?>
                     <h4>You've no requests</h4>
                      <?php } ?>
              </div>
           


        </div>
    </div> 
</div>
<?php $this->load->view('includes/footer') ?>
