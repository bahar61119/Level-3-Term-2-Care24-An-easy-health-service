<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>


<div class=""  style="min-height: 450px">
    
    <div class="container thm box">
<div class="col-md-2">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>
    
        <div class="row contents col-md-10" style="text-align: center;  padding: 10px; padding-bottom: 20px; padding-left: 50px;">

            <h3>Patient List </h3>
            <br>

              <div class="list-group">
                  <?php $i=0;
                        foreach ($users as $row) {
                            ?>
                        
                  <a href="<?php echo site_url('send_reports_con/user_profile/'.$row->id.'/'.$row->name); ?>" class="list-group-item" style="color: #339966;"><?php echo $row->name;?> </a>
                        <?php $i++;}
                        if($i==0){
                        ?>
                  <h4>No Patient available</h4>
                        <?php }?>
              </div>
           


        </div>
    </div> 
</div>
<?php $this->load->view('includes/footer') ?>
