<?php
    // include './_dbConnect.php';
class User{
    // Logged in user/admin id
    private $id;

  
    function __construct($id){
        $this->id = $id;
        // echo $this->id;
    }

    
    function checkUser($email){
        $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $res = mysqli_query($GLOBALS["conn"],$sql);
        if(mysqli_num_rows($res))
            return true;
        else
            return false;
    }

    function addUser($data){
        $fname = $data["firstname"];
        $lname = $data["lastname"];
        $email = $data["email"];
        $phone = $data["phone"];
        $gender = $data["gender"];
        $password = $data["password"];
        $user_role_id = $data["user_role_id"];

        $sql = "INSERT INTO `users` (`id`, `user_first_name`, `user_last_name`, `user_gender`, `user_phone_no`, `user_email`, `user_password`, `user_role_id`, `created_at`, `deleted_at`) VALUES (NULL, '$fname', '$lname', '$gender', '$phone', '$email', '$password', '$user_role_id', current_timestamp(), NULL);";
        $res = mysqli_query($GLOBALS["conn"],$sql);
        if($res) return true;
        else return false;
    }
  
    function getResponse($status_code,$error,$message){
        $response["status"] = $status_code;
        $response["error"] = $error;
        $response["message"] = $message;
        return $response;
    }

    function getAdminUserDetailsById($user_or_admin_id){
        // This function will fetch details for both user and admin
        $sql = "SELECT * FROM `users` WHERE id = '$user_or_admin_id'";
        $res = mysqli_query($GLOBALS["conn"],$sql);
        if(mysqli_num_rows($res)){
            $data = mysqli_fetch_assoc($res);
            return $data;
        }
        else{
            return 0;
        }
    }

    function updateUserDetails($data){
        $fname = $data["firstname"];
        $lname = $data["lastname"];
        $email = $data["email"];
        $phone = $data["phone"];
        $gender = $data["gender"];

        $id = $this->id;
        
        $sql = "UPDATE `users` SET user_first_name='$fname',user_last_name='$lname',user_gender='$gender',user_email='$email',user_phone_no='$phone' WHERE id='$id'";
        $res = mysqli_query($GLOBALS["conn"],$sql);
        if($res) return true;
        else return false;
    }

}

class Admin extends User{

    function getUserAdminListQuery($role_id){
        $sql = "SELECT * FROM `users` WHERE user_role_id = $role_id AND deleted_at IS NULL";
        $res = mysqli_query($GLOBALS["conn"],$sql);
        if($res){
            return $res;
        }
        else{
            return 0;
        }
    }
    function getAdminList(){
        //Admin Role ID is 1
        return $this->getUserAdminListQuery(1);
    }
    function getUserList(){
        //User Role ID is 2

        return $this->getUserAdminListQuery(2);
        
    }
   function deleteUser($user_id){
    $sql = "DELETE FROM `users` WHERE id = '$user_id'";
    $res = mysqli_query($GLOBALS["conn"],$sql);
    if($res)
        return true;
    else return false;
   }
   function moveUserToTrash($user_id){
    $sql = "UPDATE `users` SET deleted_at = current_timestamp() WHERE id='$user_id'";
    $res = mysqli_query($GLOBALS["conn"],$sql);
    if($res)
        return true;
    else return false;
   }
    
}
