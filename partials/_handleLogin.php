<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include './_dbConnect.php';
    include './_model.php';
    
    $email = $_POST["loginEmailAddress"];
    $password = $_POST["loginPassword"];

    $sql = "SELECT * FROM `users` WHERE user_email='$email'";
    $res = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($res)){
        if($row = mysqli_fetch_assoc($res)){
            if($row["user_password"]==$password){
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION["user_role_id"] = $row["user_role_id"];

                if($row["user_role_id"]==1){
                    header("location: /Module/admin.php");
                }
                else{
                    header("location: /Module/users.php");
                }
            }
            else{
                // header("location:".$_SERVER["HTTP_REFERER"]."?invalid=true");
                header("location: /Module/index.php?return=login&invalid=true");
            }
        } 
    }
    else{
        // header("location:".$_SERVER["HTTP_REFERER"]."?nouser=true");
        header("location: /Module/index.php?return=login&nouser=true");

    }
}
?>