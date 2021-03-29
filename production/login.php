<?php
include("config.php");
session_start();
$name=$_POST['name'];
$userName=$_POST['email'];
$telephone=$_POST['telephone'];
$userPass=$_POST['password'];
$confirmPass=$_POST['password2'];
if(isset($_POST["submitForm"])) {


    $cursor = $collection->findOne(array('email' => $userName, 'password' => $userPass));
    if ($cursor) {
        header('Location:index.php ');
    }
}
elseif(isset($_POST["registerForm"])) {


    $cursor = $collection->findOne(array('email' => $userName));
    if (empty($cursor)) {
        if ($userPass!=$confirmPass) {
            echo "<script>alert(\"Password and Confirm password should match\")</script>";

        }
        else {
            $collection->insert(array('name' => $name, 'email' => $userName, 'telephone' => $telephone, 'password' => $userPass));
            header("Location:index.php");
        }
    }
    else {
        echo "<script>alert(\"Email has already registred\")</script>";


    }

}


$_SESSION["email"]=$userName;
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="email" class="form-control"  style="color: #0f0f0f"  name="email" placeholder="Email" required="" value="<?php echo $userName?>" />
              </div>
              <div>
                <input type="password" class="form-control"  name="password" placeholder="Password" required="" />

              </div>
              <div>
                  <input  class="btn btn-default submit" name="submitForm"  type="submit" value="Log in" />

                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST">
              <h1>Create Account</h1>
              <div>
                <input type="text"  name="name" class="form-control" placeholder="Username" required="" style="color: #0f0f0f" value="<?php echo $name?>" />
              </div>
                <div>
                    <input type="email"  name="email" class="form-control" placeholder="Email" style="color: #0f0f0f" value="<?php echo $userName?>" required="" />
                </div>
                <div>
                    <input type="text"  name="telephone" class="form-control" placeholder="Telephone"  style="color: #0f0f0f"  value="<?php echo $telephone?>"required="" />
                </div>
              <div>
                  <input type="password"  name="password" class="form-control" placeholder="Password" required="" />
              </div>
                <div>
                  <input type="password"  name="password2"  data-validate-linked='password' class="form-control" placeholder="Confirm password"  />
              </div>
                <div>
                            <input  class="btn btn-default submit" name="registerForm"  type="submit" value="Submit" />
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
