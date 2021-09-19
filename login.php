<?php
$username = null;
$password = null;
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {

        $filename = 'C:\Users\GIGABYTE\Downloads\kiddocare\users.txt';
        $contents = file($filename);

        foreach($contents as $line) {

            list($username,$password) = explode("|",$line);
        
            $password =substr($password,0,-1);
            
            if($_POST["username"] == $username && $_POST["password"] == $password){
        
                $_SESSION["authenticated"] = 'true';
                $_SESSION["username"] = $_POST["username"];
                header('Location: index.php');
            }
            else {
                header('Location: login.php');
            }
        
        }
        
    } else {
        header('Location: login.php');
    }
} 

elseif(isset($_SESSION['authenticated'])){

    header('Location: index.php');

}

else {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
    <title>login</title>
</head>
<body>

<div class="d-flex justify-content-center mt-2"><div class="col-lg-5 text-center border rounded shadow m-4 py-3"><h1>Kiddocare Assignment Submission</h1></div></div>
<div class="col-lg-4 col-md-6 ml-auto mr-auto">
<div class="card mt-5 shadow">
<form id="login" method="post">
<div class="card-header">Log In</div>
<div class="card-body">

<label class="label-control">Username</label>
<input type="text" class="form-control" name="username"><br>
<label class="label-control">Password</label>
<input type="password" class="form-control" name="password"><br>
   </div>
   <div class="d-flex justify-content-center"><button type="submit" class="mt-3 mb-3 btn btn-secondary btn-round">Log in</button></div>
</form>
</div>
</div>



</body>
</html>

<?php } ?>


