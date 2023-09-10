<?php
include './_dbConnect.php';
include './_model.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();
    $user = new User($_SESSION["id"]);

    $postdata = $_POST;
    // print_r($postdata);
    // die();
    if($user->updateUserDetails($postdata)){
        if($_SESSION["user_role_id"]==1){
            header("location: /Module/admin.php?updated=true");
        }
        else if($_SESSION["user_role_id"]==2){
            header("location: /Module/users.php?updated=true");
        }
    }
    else{
            header("location: /Module/users.php?updateError=true");
    }
    
    
}
else{
    header("location: /Module/index.php?unauth=true");
}
