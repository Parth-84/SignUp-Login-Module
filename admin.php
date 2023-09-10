<?php
include './partials/_dbConnect.php';
include './partials/_model.php';
session_start();

if (isset($_SESSION["id"]) && $_SESSION["user_role_id"] == 1) {
    $admin = new Admin($_SESSION["id"]);

    $id = $_SESSION["id"];
    $res = $admin->getAdminUserDetailsById($id);

    $user_list = $admin->getUserList();
    $admin_list = $admin->getAdminList();
    // $user_for_edit = [];
    // if(isset($_SESSION["user_edit_id"])){
    //     $user_for_edit = $admin->getAdminUserDetailsById($_SESSION["user_edit_id"]);
    // }

} else {
    header("location: /Module/index.php?return=login&unauth=true");
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Users</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        body {
            padding: 25px
        }
    </style>
</head>

<body>
    <h2 class="text-center mb-3">Welcome - <?php echo $res["user_first_name"]; ?></h2>

    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    echo '
      <td>' . $res["user_first_name"] . '</td>
      <td>' . $res["user_last_name"] . '</td>
      <td>' . $res["user_gender"] . '</td>
      <td>' . $res["user_email"] . '</td>
      <td>' . $res["user_phone_no"] . '</td>
      <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Edit
    </button></td>
      ';
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Users</h2>
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    if(mysqli_num_rows($user_list)!=0){

                    while ($row = mysqli_fetch_assoc($user_list)) {
                        $count++;
                        echo '
        <tr>';
                        echo '
                        <td>' . $count . '</td>
<td>' . $row["user_first_name"] . '</td>
<td>' . $row["user_last_name"] . '</td>
<td>' . $row["user_gender"] . '</td>
<td>' . $row["user_email"] . '</td>
<td>' . $row["user_phone_no"] . '</td>
<td><button type="button"  class="btn btn-primary">
<a href="./partials/_handleDeleteTrash.php?use=trash&id='.$row["id"].'"  style="text-decoration:none; color: #fff;">
Trash
</a>
<button type="button" class="btn btn-danger mx-2" >
<a href="./partials/_handleDeleteTrash.php?use=delete&id='.$row["id"].'"  style="text-decoration:none; color: #fff;"> 
Delete
</a>
</button>
</td>
';
                        echo '
</tr>';
                    }
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <button class="btn btn-danger"><a href="./partials/_handleLogout.php" style="text-decoration:none; color: #fff;">Logout</a></button>
    </div>


    <!-- Admin Details Edit Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./partials/_handleAdminUserEdit.php" id="update-user-form">
                        <div class="row">
                            <div class="col-md-6 mb-2">

                                <div class="form-outline">
                                    <input type="text" id="firstName" class="form-control form-control-lg" name="firstname" required value="<?php echo $res["user_first_name"]; ?>" />
                                    <label class="form-label" for="firstName">*First Name</label>
                                </div>

                            </div>
                            <div class="col-md-6 mb-2">

                                <div class="form-outline">
                                    <input type="text" id="lastName" class="form-control form-control-lg" name="lastname" required value="<?php echo $res["user_last_name"]; ?>" />
                                    <label class="form-label" for="lastName">*Last Name</label>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2 pb-2">

                                <div class="form-outline">
                                    <input type="email" id="emailAddress" class="form-control form-control-lg" name="email" required value="<?php echo $res["user_email"]; ?>" />
                                    <label class="form-label" for="emailAddress">*Email</label>
                                </div>

                            </div>
                            <div class="col-md-6 mb-2 pb-2">

                                <div class="form-outline">
                                    <input type="number" id="phoneNumber" class="form-control form-control-lg" name="phone" required value="<?php echo $res["user_phone_no"]; ?>" />
                                    <label class="form-label" for="phoneNumber">*Phone Number</label>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md mb-2">

                                <h6 class="mb-2 pb-1">*Gender: </h6>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" <?php if ($res["user_gender"] == "female") echo "checked"; ?> />
                                    <label class="form-check-label" for="femaleGender">Female</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" <?php if ($res["user_gender"] == "male") echo "checked"; ?> />
                                    <label class="form-check-label" for="maleGender">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="otherGender" value="other" <?php if ($res["user_gender"] == "others") echo "checked"; ?> />
                                    <label class="form-check-label" for="otherGender">Other</label>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <p style="color: red;">* marked fields are required.</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitUpdateForm();">Update</button>
                </div>
            </div>
        </div>
    </div>


  

    <script src="./static/admin.js">
       
    </script>
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>