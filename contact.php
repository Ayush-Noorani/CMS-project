<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?> 
 <?php 

 if(isset($_POST['submit'])){

    //  $email = $_POST['email'];
     $to = "ayushnoorani6@gmail.com";
     $subject = wordwrap($_POST['subject'],70);
     $body = $_POST['body'];
     $header = $_POST['email'];

     // this is the code if you want to send a mail using php, needs SMTP config for Windows.
     //  mail($to,$subject,$bidy);

 }     
 ?>

    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject">
                        </div>
                         <div class="form-group">
                           <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
