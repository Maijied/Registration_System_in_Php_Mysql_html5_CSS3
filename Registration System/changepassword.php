/*Project Created By: Md.Maizied Hasan */

<?php

    include("connect.php");
    include("function.php");
     
     $error = "";
     if (isset($_POST['savepass'])) 
     {
     	$password = $_POST['password'];
     	$confirmPassword = $_POST['passwordConfirm'];

     	if (strlen($password)<8) 
     	{
     	     $error = "Password Must Be Greater Than 8 Characters" ;
     	}
     	else if ($password !== $confirmPassword   ) 
     	{
     		$error = "Password Does not Match";
     	}
     	else
     	{
           $password = md5($password);
           
           $email = $_SESSION['email'];
           if (mysqli_query($sylcon,"UPDATE users SET password = '$password' WHERE email = '$email'")) 
           {
           	$error = "Password Changed Succesfully ,
           	<a href = 'profile.php' ><h2>Click Here</h2></a> To Go To Your Profile";
           }
     	}
     }

    if (logged_in()) 
    {


?>
    	<?php  echo $error;  ?>
     
      <html>
  <head>
    <title>WebSystem Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  </head>
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}

</style>
<body>
<div id="wrapper1">

      <div id="formDiv">
  <form method="POST" action="changepassword.php">
     
    	<label>New Password:</label> <br/>
      <input type="password" name="password" class="inputFields" required /> <br/><br/>

      <label>Re-Enter Password:</label> <br/>
      <input type="password" name="passwordConfirm" class="inputFields" required /> <br/><br/>

      <input type="submit" name="savepass" value="Submit" /> <br/><br/>

</form>
</div>
</div>
</body>

</html>
 <?php
       
    }
    else
    {
    	header("location:profile.php");
    }

?>
