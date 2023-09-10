<?php
include './_dbConnect.php';
include './_model.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // echo json_encode("Signup Successfull");
    $postdata = $_POST;
    $postdata["user_role_id"] = 2;

    // print_r($postdata);
    $user = new User(0);

  
    if(!$user->checkUser($_POST["email"])){
        $res = $user->addUser($postdata);
        if($res){
            echo json_encode( $user->getResponse(200,null,"SignUp Succesfull!"));
        }
        else{
            echo json_encode( $user->getResponse(402,"Unprocessable Request","Please try again later"));
        }
    }
    else{
        echo json_encode( $user->getResponse(402,"Unprocessable Request","User Exists! You may proceed with login."));
      
    }

}
