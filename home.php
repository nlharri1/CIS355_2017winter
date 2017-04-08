<?php
//I am building the program this weekend 4/7/2016
session_start();
print_r(array_values($_SESSION));
    if ( !empty($_POST)) {
		if(isset($_POST['takeQuiz']))
		{
			header("Location: index.php"); 
		}
		elseif(isset($_POST['compareResults']))
		{
			header("Location: index.php"); 
		}
		elseif(isset($_POST['editProfile']))
		{
			header("Location: update_profile.php?id=". $_SESSION['test_taker_id']); 
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
	<div class="col-lg-1"></div>

  <div class="col-lg-11"><h1>Welcome <?php echo $_SESSION['username']; ?>, Are you ready for the Ultimate Quiz?!</h1></div>
	</div>

<?php
	

    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>


<br/>
<br/>
	<form class="form-horizontal" method="post">
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-9">


<button type="submit" name="takeQuiz" class="btn btn-success" style="height:40px; width:400px;">Take the Quiz</button>

</div>
</div>

<br/>
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-9">
<button type="submit" name="compareResults" class="btn btn-success" style="height:40px; width:400px;">Compare Results</button>

</div>
</div>
<br/>
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-9" >
<button type="submit" name="editProfile" class="btn btn-success" style="height:40px; width:400px;">Edit  Profile</button>
	
</div>
</div>
<br/>
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-9">
<button type="submit" name="logOut" class="btn btn-success" style="height:40px; width:400px;">Log Out</button>
	
</div>
</div>
</form>

<br/>
<br/>

</diV>
</body>
</html>