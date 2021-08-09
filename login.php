<?php 
$login=false;
$showerror=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    include 'partial/db_connect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    
    // $sql = "Select * from registration where username = '$username' && password = '$password'";
    $sql ="select * from registration where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num==1){
      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){
          $login=true;
          session_start();
          $_SESSION['loggedin']=True;
          $_SESSION['username']=$username;
          header("location: welcome.php");
          }
      }
        
        
    }
    else{
        $showerror="Invalid Credentials";
    }
    


}

?>




















<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Log In Here</title>
  </head>
  <body>
    <?php require 'partial/_nav.php' ?>
<!-- Alert -->


<?php

if($login){
echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
<strong>SUCCESSFULLY!</strong> Your Logged In Your Account.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


}
else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>FAILED!</strong> Your Credentials Do not matched.Try Again.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'.$showerror;
}

?>
<!-- alert end -->

    <div class="container">
    <h3 class="text-center">Log In To Our Website</h3>
    <form action="/loginsystem/login.php" method="POST">
  <div class="mb-3 col-md-6">
    <label for="exampleInputEmail1" class="form-label">User Name</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
  </div>
  <div class="mb-3 col-md-6">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  
  <div class="mb-3 col-md-6 form-check">
    <input type="checkbox" onclick="myFunction()" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label"  for="exampleCheck1">Show Password</label>
  </div>
  <button type="submit" class="btn btn-dark">Log In</button>
</form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
            function myFunction() {
          var x = document.getElementById("exampleInputPassword1");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>
  </body>
</html>