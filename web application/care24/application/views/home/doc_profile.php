<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<div class="color" ></div>
<div class="contents">
<div class="container thm box">
<div class="row">
    <div class="col-md-12">
<div>
<hr/>
<div>
    <h3 style="text-align: center;" class="web-font-color"><strong><?php echo $DOCTOR["name"];?></strong></h3>
     <hr/>
     <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
          <a href="#" class="">
              <img class="img-responsive img-rounded" src="<?php echo base_url();?>/assets/img/<?php  echo $DOCTOR['image']; ?>" alt="...">
          </a>
        </div>
      </div>
     
     <div class="row">
         <div class="col-lg-offset-2 col-lg-8">
             <div class="row">
          <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Name</h4>
                <div class="col-lg-8">
                <h4 class="media-heading col-lg-7 web-font-color"><?php echo $DOCTOR["name"]; ?></h4>
                <a href="#" class="col-lg-1 pull-right" onclick="">Edit</a>
              </div>
            </div>
            </div>
           </fieldset>
       <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Username</h4>
                <div class="col-lg-8">
                <h4 class="media-heading col-lg-7 web-font-color"><?php echo $DOCTOR["pen_no"]; ?></h4>
                <a href="#" class="col-lg-1 pull-right" onclick="">Edit</a>
              </div>
            </div>
            </div>
           </fieldset>
     <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Password</h4>
                <div class="col-lg-8">
                
                <a href="#" class="col-lg-8" onclick=""><h4 class="media-heading">Change Password</h4></a>
              </div>
            </div>
            </div>
           </fieldset>
     <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Phone</h4>
                <div class="col-lg-8">
                <h4 class="media-heading col-lg-7 web-font-color"><?php echo $DOCTOR["phone_no"]; ?></h4>
                <a href="#" class="col-lg-1 pull-right" onclick="">Edit</a>
              </div>
            </div>
            </div>
           </fieldset>
     <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Email</h4>
                <div class="col-lg-8">
                <h4 class="media-heading col-lg-7 web-font-color"><?php echo $DOCTOR["email"]; ?></h4>
                <a href="#" class="col-lg-1 pull-right" onclick="">Edit</a>
              </div>
            </div>
            </div>
           </fieldset>
     <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Address</h4>
                <div class="col-lg-8">
                <h4 class="media-heading col-lg-7 web-font-color"><?php echo $DOCTOR["address"]; ?></h4>
                <a href="#" class="col-lg-1 pull-right" onclick="">Edit</a>
              </div>
            </div>
            </div>
           </fieldset>
     <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Specialist</h4>
                <div class="col-lg-8">
                <h4 class="media-heading col-lg-7 web-font-color"><?php echo $DOCTOR["specialist"]; ?></h4>
                <a href="#" class="col-lg-1 pull-right" onclick="">Edit</a>
              </div>
            </div>
            </div>
           </fieldset>
         </div>
         </div>
     </div>
</div>
<hr/>

</div>
    </div>      
</div>   

</div> 
</div> 


<?php $this->load->view('includes/footer')?>