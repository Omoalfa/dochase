<?php
include('../../includes/dbconfig.php');

$uid = "UIKDLpeLGncLkLKLtxbMzcTEca32";

if(isset($_POST['submit']))
{
    $email = $_POST['inputEmail'];
    $pass = $_POST['inputPassword'];
    $auth = $firebase -> createAuth();
    try{
        $user = $auth -> signInWithEmailAndPassword($email, $pass);
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION["user"] = $email;
        header("Location: dashboard.php");
        # code...
    } catch(\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
        // echo $e->getMessage();
        $message = $e->getMessage();
        if ($message == "USER_DISABLED") {
            $updatedUser = $auth->enableUser($uid);
            $user = $auth -> signInWithEmailAndPassword($email, $pass);
            $_SESSION["user"] = $email;
            header("Location: dashboard.php");
            # code...
        }
    }
    
?>
        
<?php
       
    }
 else if(isset($_POST['logout'])) {
    session_start();

    $auth = $firebase -> createAuth();
    
    $users = $auth->getUser($uid);
    $updatedUser = $auth->disableUser($uid);
    unset($_SESSION['authenticated']);
    
    header("Location: sign-in.html");
}

function createNewUser () {
    $userProperties = [
        'uid' => $uid,
        'email' => 'user@example.com',
        'emailVerified' => false,
        'phoneNumber' => '+15555550100',
        'password' => 'secretPassword',
        'displayName' => 'John Doe',
        'photoUrl' => 'http://www.example.com/12345678/photo.png',
        'disabled' => false,
    ];
    $createdUser = $auth->createUser($userProperties);
}
    

?>
    