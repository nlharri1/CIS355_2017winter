<?php
//I am building the program this weekend 4/7/2016

 session_start();
//connect to database

$db=mysqli_connect("localhost","nlharri1","537858","nlharri1");

?>
<!DOCTYPE html>
<html>
<head>
  <title>UltimateQuiz</title>
      <meta charset="utf-8">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
    <h1>Prepare Yourself</h1>
</div>
<?php
	

    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>


<div>
    <h4>Welcome <?php echo $_SESSION['username']; ?>, Are you ready for the Ultimate Quiz?!</h4></div>
</div>
<div>
	<table>
	<tr>
		<td><a href="">Play</a></td>
	</tr>
	<tr>
		<td><a href="">Compare Results</a></td>
	</tr>
	<tr>
		<td><a href="">Edit Profile </a></td> 
	</tr>
	 </table>
</div>
<br/>
<br/>
<a href="logout.php">Log Out</a>
</body>
</html>