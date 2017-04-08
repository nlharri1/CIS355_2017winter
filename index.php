<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","nlharri1","537858","nlharri1") or die ("connection error");

if(isset($_POST['login_btn']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
    $password=md5($password); //Remember we hashed password before storing last time
    $sql="SELECT * FROM Test_Takers WHERE username='$username' AND password='$password'";

    $result=mysqli_query($db,$sql);
	
    if(mysqli_num_rows($result)==1)
    {
		//$row = mysqli_fetch_row($result);
        $_SESSION['message']="You are now Logged In";
		$_SESSION['username'] = $username;
        //$_SESSION['username']=$row[3];
        header("location:home.php");
    }
   else
   {
		$_SESSION['message']="Username and Password combination incorrect";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Ultimate Quiz</title>

    <meta charset="utf-8">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div class="header">
    <h1>Can You Master the Ultimate Quiz?</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="home.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In"></td>
     </tr>
  
</table>
<br />
<a href="register.php">Register new account</a>
</form>
</body>
</html>
 