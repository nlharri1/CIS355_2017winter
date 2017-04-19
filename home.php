<?php
require 'database.php';
//I am building the program this weekend 4/7/2016
session_start();
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT count(*) AS Count FROM information_schema.columns WHERE table_name = 'Questions'";
	$q = $pdo->prepare($sql);
	$q->execute();
	$results = $q->fetch(PDO::FETCH_ASSOC); 
	
	Database::disconnect();
	 $_SESSION['numOfQuestions'] = $results['Count'];

	
    if ( !empty($_POST)) {
		if(isset($_POST['takeQuiz']))
		{
			header("Location: take_quiz.php"); 
		}
		elseif(isset($_POST['compareResults']))
		{
			header("Location: results.php"); 
		}
		elseif(isset($_POST['editProfile']))
		{
			header("Location: update_profile.php?id=". $_SESSION['test_taker_id']); 
		}
		elseif(isset($_POST['createQuiz']))
		{
			header("Location: create_quiz.php"); 
		}
		elseif(isset($_POST['manageQuiz']))
		{
			header("Location: manage_quiz.php"); 
		}
		else
		{
			header("Location: logout.php"); 
		}
	}




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
<div class="container">
<div  class="row">
	<div class="col-lg-2 col-xs-1"></div>

  <div class="col-lg-10 col-xs-11"><h1>Are you ready for the Ultimate Quiz?!</h1></div>
	</div>

<br/>
<br/>
	<form class="form-horizontal" method="post">
<div class="row">
<div class="col-lg-3 col-xs-3"></div>
<div class="col-lg-9 col-xs-9">


<button type="submit" name="takeQuiz" class="btn btn-success" style="height:40px; width:400px;">Take the Quiz</button>

</div>
</div>

<br/>
<div class="row">
<div class="col-lg-3 col-xs-3"></div>
<div class="col-lg-9 col-xs-9">
<button type="submit" name="compareResults" class="btn btn-success" style="height:40px; width:400px;">View Results</button>

</div>
</div>
<br/>
<div class="row">
<div class="col-lg-3 col-xs-3"></div>
<div class="col-lg-9 col-xs-9" >
<button type="submit" name="editProfile" class="btn btn-success" style="height:40px; width:400px;">Edit  Profile</button>
	
</div>
</div>
<br/>
<div class="row">
<div class="col-lg-3 col-xs-3"></div>
<div class="col-lg-9 col-xs-9">
<button type="submit" name="logOut" class="btn btn-success" style="height:40px; width:400px;">Log Out</button>
	
</div>
</div>

</form>

<br/>
<br/>

</diV>
</body>
</html>