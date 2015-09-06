<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/navigation') ?>
<?php $this->load->view('includes/search') ?>
<div class="contents">
    <div class="container thm box">
        <div class="row" style="padding: 10px; padding-bottom: 20px;">
            <form class="form-horizontal form-signin-signup" method="post" action="<?php echo base_url(); ?>index.php/home_con">

                <?php form_open(); ?>      
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">

                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">


                </div>


                <input type="submit" value="Submit" class="btn btn-primary btn-large">

            </form>
        </div>
    </div> 
</div>
<?php $this->load->view('includes/footer') ?>
