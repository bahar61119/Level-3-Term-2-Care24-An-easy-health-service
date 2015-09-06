<?php $this->load->view('includes/header')?>
<?php $this-> load->view('includes/navigation')?>
<?php $this-> load->view('includes/search')?>
<?php //$this-> load->view('includes/jumbotron')?>
<div class="contents">
<div class="container thm box">
<div class="row">
    <div class="col-md-3">
        <?php $this-> load->view('home/home-side-contents')?>
    </div>
    <div class="col-md-9">
        <?php $this-> load->view('home/home-contents')?>
    </div>
</div>      
</div>   

<?php $this->load->view('includes/footer')?>

</div> 