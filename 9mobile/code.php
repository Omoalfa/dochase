<?php 
use AfricasTalking\SDK\AfricasTalking;
require './includes/vendor/autoload.php';
include('./includes/dbconfig.php');
session_start();

date_default_timezone_set('Africa/Lagos');

if(isset($_POST['submit']))
{
    $name = $_POST['userName'];
    $email = $_POST['emailAddress'];
    $phone = $_POST['phoneNumber'];
    $amount = 300;
    $date = date('Y-m-d');
    $time = date("g:i a");

    $pattern = '/^234[0-9]{10}/';
    $convert_phone = (int) $phone;
    if(preg_match($pattern,$convert_phone))
    {   
        $ref = "contact/";
        $getdata = $database->getReference($ref)->getValue();

        $leads_count = count($getdata);

        if($leads_count<1223){
            
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'amount' => $amount,
                'date' => $date,
                'time' => $time
            ];
        
            
        
            //Conditional statement to check if the user exists in the firebase db
            //If yes, alert an error message
            //If no, push to firebase db
            foreach($getdata as $key => $row){
                if($row["phone"]==$phone || $row["email"]==$email){
                    $_SESSION["duplicate"] = "<strong> Sorry, double entry. You have been credited already!</strong>";
                    
                }
                
            }
        
            if($_SESSION["duplicate"]){
                header("Location: index.php");
            }
            else{
                    
                $postdata = $database->getReference($ref)->push($data);
        
                // require '../includes/vendor/autoload.php';
                // use AfricasTalking\SDK\AfricasTalking;
        
                // Set your app credentials
                $username = "Ads";
                $apikey   = "6892edff91326f49af848eaffd078242b331c5f9ffbb1303028e0e7040ff8130";
                
                // Initialize the SDK
                $AT       = new AfricasTalking($username, $apikey);
        
                // Get the airtime service
                $airtime  = $AT->airtime();
        
                // Set the phone number, currency code and amount in the format below
                $recipients = [[
                    "phoneNumber"  => $phone,
                    "currencyCode" => "NGN",
                    "amount"       => $amount
                ]];
        
                try {
                    // That's it, hit send and we'll take care of the rest
                    $results = $airtime->send([
                        "recipients" => $recipients
                    ]);
        
                    // print_r($results);
                    if($postdata && $results["status"] == "success"){
                        $_SESSION['status'] = "<strong> Congratulations, your phone number has been credited successfully.</strong> Kindly visit <a href='https://9mobile.com.ng' class='text-success' target='_blank'>9mobile promo page</a> to find out more!";
                        header("Location: index.php");
                    }elseif($results["status"] == "Failed"){
                        $_SESSION['status'] = "<strong> Oops, something Went Wrong. Please, try again!</strong>";
                        header("Location: index.php");
                    }
                } catch(Exception $e) {
                    echo "Error: ".$e->getMessage();
                }
            }
        }
        else{
            header("Location: index.php");
        }
        
    }
    else{
        $_SESSION["wrongNumber"] = "<strong> Sorry, invalid phone number entry!</strong> Please, enter valid phone number, e.g +2348112223333";
        header("Location: index.php");
    }
    

}
?>