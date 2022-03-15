<?php include("./includes/header.php");
session_start();
use AfricasTalking\SDK\AfricasTalking;
require './includes/vendor/autoload.php';
include('./includes/dbconfig.php');

date_default_timezone_set('Africa/Lagos');

$ref = "contact/";
$getdata = $database->getReference($ref)->getValue();
$leads_count = count($getdata);
?>
<div class ="custom_body">
    <div style="overflow:hidden; max-width:100%; height: 130px;">
        <iframe src="https://9mobile.com.ng" scrolling="no" style="border: 0px none; margin-left: 0px; height: 130px; margin-top: 0px; width: 100%;">
        </iframe>
    </div>
    <div class="transbox">
      <!-- <img src="../img/Mega_Mellion_Promo1.jpg" alt="9Mobile_Mega_Promo">
      <div class="col-md-12"> -->
      <div class="col-md-6 offset-md-3">
        <img src="./img/9Mobile_promo.png" width="100%" alt="9Mobile_Mega_Promo">
            <?php
            if($leads_count>=1223){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry, we've gotten our airtime winners already. Please, try later!!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
           <?php }
             elseif(isset($_SESSION["wrongNumber"]) && $_SESSION["wrongNumber"] != ""){ 
           ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["wrongNumber"]?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <?php unset($_SESSION["wrongNumber"]); }
           elseif(isset($_SESSION["status"]) && $_SESSION["status"] != ""){ 
           ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["status"]?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <?php unset($_SESSION["status"]); } 
           elseif(isset($_SESSION["duplicate"]) && $_SESSION["duplicate"] != ""){ 
            ?>
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <?php echo $_SESSION["duplicate"]?>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <?php unset($_SESSION["duplicate"]); } ?>
        <form action="code.php" method="post" validate="validate">
            <div class="alert alert-info text-center" role="alert">
                Fill in your details below to win free airtime and join the promo challenge!
            </div>

            <div class="input-group">
                <input type="text" name="userName" class="form-control" placeholder="Enter Your Name Here" required>
            </div><br>
            <div class="input-group">
                <input type="email" name="emailAddress" class="form-control" placeholder="Enter email address" required>
            </div><br>
            
            <div class="input-group">
                <input type="text" name="phoneNumber" class="form-control" placeholder="Enter phone number, format: +23481XXX" required>
            </div>
            <br>

            <span><input type="checkbox" aria-label="Checkbox for following text input" required>
                By ticking this box, you agree to 9mobile <a href="https://9mobile.com.ng/terms-conditions" class="text-success" target="_blank"> terms and conditions</a>.
            </span>
            <hr>
            <?php
                if($leads_count>=1223){ ?>
                    <input type="submit" name="submit" value="Submit" class="btn btn-success btn-flat btn-block btn-lg " disabled>
               <?php }else{?>
                    <input type="submit" name="submit" value="Submit" class="btn btn-success btn-flat btn-block btn-lg ">
               <?php }
            ?>
    
        </form>
      </div>
    </div>
</div>
    
<?php include("./includes/footer.php")?>