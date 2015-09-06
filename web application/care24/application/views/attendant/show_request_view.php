<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<?php $this-> load->view('includes/search')?>


<div class="row" style="padding: 10px 10px 10px 10px;">
</div>
<div>    
        <div class="container thm box">
<div class="row">
    <div class="col-md-3">
        <?php // $this-> load->view('home/home-side-contents')?>
    </div>
    <div class="col-md-9">
       
    


<div>
     <h3 style="text-align: center;"><strong>Appointments Request List </strong></h3>
     <hr/>
	 <div>
		
        <?php
        echo form_open('schedule_appointment/search_appointment');
        ?>

                  <div class="form-group ">
                      <div class="form-group col-md-4">
                    <?php if (isset($error)){ echo $error;}?>     
                       <?php echo  'Doctor Name'?>
                          <select name="doctor_name"class=" form-control btn search-bar-size">
                      <option></option>
                      
                      <?php
                    if (isset($drecords)) {
                        foreach ($drecords as $row) {
                            $results[] = $row;
                            if ($row->name) {
                                ?>
                      <option value='<?php echo $row->id ?>' ><?php echo $row->name ?></option>
                 <?php }}}?>
                      </select>
                          </div>
                      </br> </br> </br> </br>
                      <div class="form-group col-md-4">
                        <?php echo  'Day'?>
                     <select name="day"class=" form-control btn search-bar-size">
                      <option>01</option>
                      <option>02</option>
                      <option>03</option>
                      <option>04</option>
                      <option>05</option>
                      <option>06</option>
                      <option>07</option>
                      <option>08</option>
                      <option>09</option>
                      <option>10</option>
                     <option>11</option>
                      <option>12</option>
                      <option>13</option>
                      <option>14</option>
                      <option>15</option>
                     <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option>19</option>
                      <option>20</option>
                     <option>21</option>
                      <option>22</option>
                      <option>23</option>
                      <option>24</option>
                      <option>25</option>
                      <option>26</option>
                      <option>27</option>
                      <option>28</option>
                      <option>29</option>
                      <option>30</option>
                      <option>31</option>
                     </select>
                          </div>
                      <div class="form-group col-md-4">
                       <?php echo  'Month'?>
                     <select name="month" class=" form-control btn search-bar-size">
                      <option>01</option>
                      <option>02</option>
                     <option>03</option>
                      <option>04</option>
                      <option>05</option>
                      <option>06</option>
                      <option>07</option>
                      <option>08</option>
                      <option>09</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                      
                      
                     </select>
                          </div>
                      <div class="form-group col-md-4">
                           <?php echo  'Year'?>
                     <select name="year" class=" form-control btn search-bar-size">
                      <option>2013</option>
                      <option>2014</option>
                      <option>2015</option>
                      <option>2016</option>
                      <option>2017</option>
                     </select>
                      </div>
                  </div>
                  </br>  
                  <button type="submit" id="search-btn" class="col-md-4 btn btn btn-success search-bar-size">
                      Search Appointments</button>
                          <?php echo form_close(); ?>
         
	 	
	 	  </div>
		  </br>
		  </br></br></br></br>
		      <div class="media" >
                          </br></br></br></br></br>
                  <?php
                    if (isset($records)) {
                        foreach ($records as $row) {
                            $results[] = $row;
                            if ($row->adate) {
                                ?>
                    
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
                    <?php echo"----------------------------------------------------------";?>
                    </br>
                    <p3 style="text-align: left;"><strong>Doctor Name: </strong></p3>
                           <p1> <strong>    <?php echo "Dr.".$row->dname; ?></strong></p1>
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
                    <div class="form-actions">
                        <form id="validate-1" class="col-md-3"  
              action="<?php echo base_url(); ?>index.php/schedule_appointment/approve_set_time/<?php echo $row->aid.'?d_id='.$_GET["d_id"]; ?>" 
              method="post" >
                     <fieldset>
            <legend>Give Time</legend>
          
            <input type="text" class=" form-control search-bar-size" placeholder="Give time" name="time">
			 
			
 </fieldset>
                    </br></br>
			
                     
                                    
                                         
                                        <button type="submit" class="btn btn btn-success add-bar-size">Approve</button>
                                    </form>
                                </div>
                    </br></br></br></br></br></br></br></br></br>
		  
		  <div class="form-actions">
                                    <form id="validate-1" class="col-md-2" 
                                          action="<?php echo base_url(); ?>index.php/schedule_appointment/cancel_appointment/<?php echo $row->aid.'?d_id='.$_GET["d_id"]; ?>" method="post" >
                                        <button type="submit" class="btn btn btn-success add-bar-size">Cancel</button>
                                    </form>
                                </div>
		  </div>
		  </br></br>
	  
      <hr/>
	  </div>
</div>      <?php
                            }
                             
                        }
                    }
                    ?>
</div>   
</div>
</div>
<?php $this->load->view('includes/footer')?>
