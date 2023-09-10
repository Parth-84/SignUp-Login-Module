<!doctype html>
<html lang="en">

<head>
  <title>
    Skill Module
  </title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="./static/style.css">
</head>

<body>
  <div class="alert alert-dismissible fade show w-100" id="alert-module" role="alert" style="display:none;">
  </div>
  <section class="main-block container-fluid">
    <section class="container signup-form" id="signup-form">
      <h2>Sign Up</h2>
      <form>
        <div class="row">
          <div class="col-md-6 mb-2">

            <div class="form-outline">
              <input type="text" id="firstName" class="form-control form-control-lg" required />
              <label class="form-label" for="firstName">*First Name</label>
            </div>

          </div>
          <div class="col-md-6 mb-2">

            <div class="form-outline">
              <input type="text" id="lastName" class="form-control form-control-lg" required />
              <label class="form-label" for="lastName">*Last Name</label>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-2 pb-2">

            <div class="form-outline">
              <input type="email" id="emailAddress" class="form-control form-control-lg" required />
              <label class="form-label" for="emailAddress">*Email</label>
            </div>

          </div>
          <div class="col-md-6 mb-2 pb-2">

            <div class="form-outline">
              <input type="tel" id="phoneNumber" class="form-control form-control-lg" required />
              <label class="form-label" for="phoneNumber">*Phone Number</label>
            </div>

          </div>
        </div>

        <div class="row">

          <div class="col-md mb-2">

            <h6 class="mb-2 pb-1">*Gender: </h6>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" checked />
              <label class="form-check-label" for="femaleGender">Female</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" />
              <label class="form-check-label" for="maleGender">Male</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="otherGender" value="other" />
              <label class="form-check-label" for="otherGender">Other</label>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-2">

            <div class="form-outline">
              <input type="text" id="password" class="form-control form-control-lg" required />
              <label class="form-label" for="password">*Password</label>
            </div>

          </div>
          <div class="col-md-6 mb-2">

            <div class="form-outline">
              <input type="text" id="cPassword" class="form-control form-control-lg" required />
              <label class="form-label" for="cPassword">*Confirm Password</label>
            </div>

          </div>
        </div>
        <div class="row">
          <p style="color: red;">* marked fields are required.</p>
          <p id="signup-error-msg" style="color: red;"></p>
        </div>
        <div class="mt-1 form-inline">
          <button class="btn btn-primary btn-md mx-2" type="button" onclick="validate();">Submit</button>
          <button class="btn btn-danger btn-md" type="button" onclick="openLoginForm();">Login</button>
        </div>

      </form>

    </section>
    <section class="container login-form" id="login-form">
      <h2>Login</h2>
      <form method="POST" action="./partials/_handleLogin.php">

        <div class="row">
          <div class="mb-2 pb-2">

            <div class="form-outline">
              <input type="email" id="loginEmailAddress" name="loginEmailAddress" class="form-control form-control-lg" required />
              <label class="form-label" for="emailAddress">*Email</label>
            </div>
            <div class="form-outline">
              <input type="text" id="loginPassword" name="loginPassword" class="form-control form-control-lg" required />
              <label class="form-label" for="password">*Password</label>
            </div>
          </div>
        </div>
        <div id="login-error-msg">
          <?php 
          if (isset($_GET["nouser"])) {
            echo '<p class="p-2" style="color: #fff; background-color: red;">No User Found.</p>';
          }
          if (isset($_GET["invalid"])) {
            echo '<p class="p-2" style="color: #fff; background-color: red;">Invalid Credentials.</p>';
          }
          ?>
        </div>
        <div class="row">
          <div class="mb-2 pb-2">
            <button class="btn btn-primary btn-md mx-2" type="submit">Submit</button>
            <button class="btn btn-danger btn-md" type="button" onclick="openSignupForm();">Signup</button>
          </div>
        </div>

      </form>
    </section>

  </section>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="./static/script.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>