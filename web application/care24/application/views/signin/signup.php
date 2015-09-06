<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<?php $this-> load->view('includes/search')?>
<div class="contents">
<div class="container thm box">
<div class="row" style="padding: 10px; padding-bottom: 20px;">
 
    
    <form class="form-horizontal form-signin-signup" method="post" action="<?php echo base_url(); ?>index.php/signup_con/check_signup">

  <?php form_open() ;?>      
  <div class="form-group">
    <label for="exampleInputEmail1">Name*</label>
    <input type="text" class="form-control" id="username" placeholder="Your Full Name">
   <label for="exampleInputPassword1">Email*</label>
   <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email here">
    
     <label for="exampleInputPassword1">Password*</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  
    
       <label for="exampleInputPassword1">Confirm Password*</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
 
    
     <label for="exampleInputPassword1">Specialist*</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="What type of speciaist you are? eg: cardiology">
  
     <label for="exampleInputPassword1">Pen No*</label>
     <input type="tel" class="form-control" id="exampleInputPassword1" placeholder="Your Pen No">
  
     
     <label for="exampleInputPassword1">Phone No</label>
     <input type="tel" class="form-control" id="exampleInputPassword1" placeholder="eg: 017xxxxxxxx">
  
    
     <label for="exampleInputPassword1">Address</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="eg: suhrawardy hall,BUET">
  
  
  </div>
  <div>
      
   </div>
  
       <input type="submit" value="SignUp" class="btn btn-primary btn-large">
    </form>
</div>
</div> 
</div>
<?php $this->load->view('includes/footer')?>
