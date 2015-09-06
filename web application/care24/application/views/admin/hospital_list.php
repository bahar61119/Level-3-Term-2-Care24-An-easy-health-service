<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>


<div class=""  style="min-height: 450px">
    
    <div class="container thm box">
<!--<div class="col-md-3">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>-->
    
        <div class="row contents col-md-12" style="text-align: center;  padding: 10px; padding-bottom: 20px; padding-left: 50px;">

            <h3>Hospital List </h3>
            <br>

              <div class="list-group">
                  <?php $i=0;
                        foreach ($hospitals as $row) {
                            ?>
                        
                  <a href="<?php echo site_url('admin_con/hospital_profile?h_id='.$row->id); ?>" class="list-group-item" style="color: #339966;"><?php echo $row->h_name;?> </a>
                        <?php $i++;}
                        if($i==0){
                        ?>
                  <h4>No Hospital is active</h4>
                        <?php }?>
              </div>
           


        </div>
    </div> 
</div>
<?php $this->load->view('includes/footer') ?>
