<?php
$cookie_name = "name";
$cookie_value = "ren";
setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/");
?>

<?php include('header.php'); ?>
      <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-8 col-md-6 col-lg-4 m-4 mt-7 pt-4 pb-4" id="login">
          <form action="app.php" method="post">
            <h1>Welcome</h1>
            Name<br><input type="text" class="form-control" name="name"><br>
            Password<br><input type="password" class="form-control" name="password"><br>
					<input type="submit" value="Login" class="form-control btn btn-primary">
          </form>
          <?php
          if(isset($_GET['error'])){
            echo '
          <div id="error" class="text-center m-3">'.$_GET['error'].'</div>';
          }
          ?>
        </div>
      </div>
    </div>
</div>
<div id="sidebar" class=" col-2"></div>
<div id="sidebar" class=" col-10">
<?php include('footer.php'); ?>
