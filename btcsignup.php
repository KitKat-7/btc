<?php session_start(); ?>
<?php

include('conn.php');

$username = $_POST['username'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$accno = $_POST['accno'];
$ifsc = $_POST['ifsc'];
$micr = $_POST['micr'];

if (empty($username) || empty($email) || empty($tel) || empty($password1) || empty($password2) || empty($accno) || empty($ifsc) || empty($micr) ){
    echo "<script>
    alert('All Fields Are Required');
    window.location.href='signup.html';
    </script>";
}
else {

if (mysqli_connect_error()) {
    die('Connection Failed('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else {

    $uname = "SELECT username from register where username = ? Limit 1";
    $INSERT = "INSERT into register(username  ,email , tel ,password1 ,password2 ,accno ,ifsc ,micr) values(?,?,?,?,?,?,?,?)";

    $namestmt = $conn->prepare($uname);
    $namestmt->bind_param("s", $username);
    $namestmt->execute();
    $namestmt->bind_result($username);
    $namestmt->store_result();
    $usernum = $namestmt->num_rows;

if($usernum!=0){
    echo "<script>
    alert('username already taken ,try another');
    window.location.href='signup.html';
    </script>";
}
    
else {

    $mail = "SELECT email from register where email = ? Limit 1";
    $INSERT = "INSERT into register(username  ,email , tel ,password1 ,password2 ,accno ,ifsc ,micr) values(?,?,?,?,?,?,?,?)";

    $emailstmt = $conn->prepare($mail);
    $emailstmt->bind_param("s",$email);
    $emailstmt->execute();
    $emailstmt->bind_result($email);
    $emailstmt->store_result();
    $emailnum = $emailstmt->num_rows;

if($emailnum!=0){
    echo "<script>
    alert('someone already registered with this email');
    window.location.href='signup.html';
    </script>";        
}
else {

    $telph = "SELECT tel from register where tel = ? Limit 1";
    $INSERT = "INSERT into register(username  ,email , tel ,password1 ,password2 ,accno ,ifsc ,micr) values(?,?,?,?,?,?,?,?)";

    $telstmt = $conn->prepare($telph);
    $telstmt->bind_param("i", $tel);
    $telstmt->execute();
    $telstmt->bind_result($tel);
    $telstmt->store_result();
    $telnum = $telstmt->num_rows;

if($telnum!=0){
    echo "<script>
    alert('someone already registered with this mobile number');
    window.location.href='signup.html';
    </script>";
}
else {
if($password1!=$password2){
    echo "<script>
    alert('Password Mismatch');
    window.location.href='signup.html';
    </script>";
}

else {
    $accnum = "SELECT accno from register where accno = ? Limit 1";
    $INSERT = "INSERT into register(username  ,email , tel ,password1 ,password2 ,accno ,ifsc ,micr) values(?,?,?,?,?,?,?,?)";

    $accnumstmt = $conn->prepare($accnum);
    $accnumstmt->bind_param("i", $accno);
    $accnumstmt->execute();
    $accnumstmt->bind_result($accno);
    $accnumstmt->store_result();
    $accnonum = $accnumstmt->num_rows;

if($accnonum!=0){
    echo "<script>
    alert('Account Number Already In Use');
    window.location.href='signup.html';
    </script>";
}

else {
    $otp = rand(100000,999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['mail'] = $email;
    require "PHPMailerAutoload.php";
    $mail = new PHPMailer;
    
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='johnmounesh77@gmail.com';
    $mail->Password='singleda';
    
    $mail->setFrom('johnmounesh77@gmail.com','BTC Verification');
    $mail->addAddress($_POST["email"]);
    
    $mail->isHTML(true);
    $mail->Subject="Your verify code";
    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
    <br><br>
    <p>With regrads,</p>
    <h3>BTC Pyscology";
    
    
if(!$mail->send()) {
    echo "<script>
    alert('Invalid Email');
    window.location.href='signup.html';
    </script>";
}
else {
    $sql = "INSERT into register(username  ,email , tel ,password1 ,password2 ,accno ,ifsc ,micr) values('$username','$email','$tel','$password1','$password2','$accno','$ifsc','$micr')"; 
    if ($conn->query($sql) === TRUE) {
        echo "<script>
    alert('Otp sent to your Email');
    window.location.href='verify.php';
    </script>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
}

}
}
}
}
}
}
$conn->close();
}
        
        

?>

