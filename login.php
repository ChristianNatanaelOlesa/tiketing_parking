<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Parking System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="assets/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="assets/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="assets/login/css/main.css">
<!--===============================================================================================-->
<!-- SweetaAlert -->
<script src="assets/link/sweetalert.min.js"></script>
</head>
<body>
<?php if(isset($_SESSION['pesan']) && $_SESSION['pesan'] != '') { ?>
  <script>
    swal({
      title: "<?php echo $_SESSION['pesan']; ?>",
      icon: "<?php echo $_SESSION['kode_pesan']; ?>",
    });
  </script>
<?php 
  unset($_SESSION['pesan']);
} ?>
  <div class="limiter">
    <div class="container-login100">
      <div class="login100-pic js-tilt" data-tilt>
        <img src="assets/login/images/img-01.png" alt="IMG">
      </div>

      <form class="login100-form validate-form" action="cek_login.php" method="post">
        <span class="login100-form-title">
          QR LOGIN PLN
        </span>

        <div class="wrap-input100 validate-input">
          <input class="input100" type="text" name="username" placeholder="Username">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-user" aria-hidden="true"></i>
          </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
          <input class="input100" type="password" name="password" placeholder="Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>
        
        <div class="container-login100-form-btn">
          <button class="login100-form-btn">
            Login
          </button>
        </div>
      </form>
      
    </div>
  </div>
  
<!--===============================================================================================-->  
  <script src="assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="assets/login/vendor/bootstrap/js/popper.js"></script>
  <script src="assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="assets/login/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="assets/login/js/main.js"></script>

</body>
</html>