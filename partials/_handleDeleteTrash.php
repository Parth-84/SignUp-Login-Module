<?php
include './_dbConnect.php';
include './_model.php';

session_start();
if(isset($_SESSION["id"]) && $_SERVER["REQUEST_METHOD"]=="GET"){
    $user_id = $_GET["id"];
    $usage = $_GET["use"];

    $admin = new Admin($_SESSION["id"]);
    if($usage == "trash"){
       $res = $admin->moveUserToTrash($user_id);
        if($res){
            echo "Moved Succesfull";
            header("location: /Module/admin.php?moved=true");
        }
        else{
            echo "Moved Unsuccesfull";
            header("location: /Module/admin.php?moved=false");
        }
    }
    else if($usage == "delete"){
        $res = $admin->deleteUser($user_id);
        if($res){
            echo "Deleted Succesfull";
            header("location: /Module/admin.php?delete=true");
        }
        else{
            echo "Deleted Unsuccesfull";
            header("location: /Module/admin.php?delete=false");
        }
    }
    else {
            echo json_encode("Error");
    }

    exit;
}
else{
    header('location: /Module/index.php?unAuth=true');
}
?>