<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html {
    scroll-behavior: smooth;
}


#navbar {
    z-index: 100;
    top: 0;
    left: 0;
    background-color: #171F2F;
    text-align: center;
    display: flex;
}

.navbar-brand{
    display: flex;
}

.navbar-brand h1{
    font-size: 22px;
}

body {
    text-align: center;
    background-color: rgb(24, 122, 202);
}

.container{
    width: 100%;
}

.container h1 {
    padding: 20px;
    justify-content:center;
}

.box input[type="submit"] {
    font-weight: 700;
    width: 100px;
    margin-left: auto;
    margin-right:auto;
    padding: 10px 20px;
    border-radius: 20px;
}

.box input[type="text"] {
        text-align: center;
        background:rgba(0, 0, 0, 0.582);
        display: block;
        margin: 10px auto;       
        border: 3px solid #2b344d;
        padding:4px 10px;
        width: 350px;
        outline: none;
        color: white;
        border-radius: 5px;
        transition: 0.25px;
}


</style>
</head>
<body>

<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-dark " id="navbar">
<div class="container-fluid">
    <a class="navbar-brand mx-auto" href="index.html">
    <img src="btc.jpg" alt="" width="70" height="64">
    <h1 class="navbar-brand px-3 text-center">BTC</br>Physcology</h1> </a>
    </a>
</div>
</nav>

<div class="container">
<h1>OTP Verification</h1>
<form class="box" action="verify.php" method="post">
    <input type="text" id="otp" placeholder="Enter OTP" name="otp_code" required></br>
    <input type="submit" value="Verify" name="verify">
</form>
</div>

</body>
</html>


<?php 

include('conn.php');
    
if(isset($_POST["verify"])){
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if($otp != $otp_code){
        ?>
       <script>
           alert("Invalid OTP code");
       </script>
       <?php
    }else{
        ?>
         <script>

             alert("Verfiy account done, you may Log In now");
               window.location.replace("login.html");
         </script>
         <?php
    }

}

?>