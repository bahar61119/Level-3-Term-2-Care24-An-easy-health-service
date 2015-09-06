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
    <h3 style="text-align: center;" class="web-font-color"><strong>Send Report</strong></h3>
     <hr/>
<!--     <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
          <a href="#" class="">
              <img class="img-responsive img-rounded" src="<?php echo base_url();?>/assets/img/<?php  echo $ADMIN['image']; ?>" alt="...">
          </a>
        </div>
      </div>-->
     
     <div class="row">
         <div class="col-lg-offset-2 col-lg-8">
             <div class="row">
             <?php echo form_open_multipart('send_reports_con/upload_report');?>
<!--<form method="post" accept-charset="utf-8" action="<?php echo site_url("send_reports_con/upload_report"); ?>">-->

                 
                 <fieldset>
              <hr/>
            <div class="media">
              <div class="media-body">
                <h4 class="media-heading col-lg-3">Prescription no:</h4>
                <div class="col-lg-8">
                    <select required name="p_id" style="width:200px;">
                 <?php
                        foreach ($options as $row) {
                 ?>
                        <option style="width:100px;" value="<?php echo $row->id;?>"><?php echo $row->id;?></option>
                        <?php }?>
                        </select>
              </div>
            </div>
            </div>
           </fieldset>
                 <br><br><hr>
                 <fieldset>
                 <?php echo form_open_multipart('send_reports_con/upload_report');?>

<input type="file" class="btn" name="userfile" size="200" />

<br /><br />

<input class="btn btn-success" type="submit" value="upload" />

</fieldset>
<!--</form>-->
<?php echo form_close();?>
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