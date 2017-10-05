/*Project Created By: Md.Maizied Hasan */

<?php
  
  include("connect.php");
  include("function.php");

   if (logged_in()) 
  {
    header("location:profile.php");
    exit();
  }

  $error = "";


  if(isset($_POST['submit']))
  {
    $firstName =mysql_real_escape_string( $_POST['fname']);
    $lastName = mysql_real_escape_string($_POST['lname']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $imageSize = $_FILES['image']['size'];

    $conditions = isset($_POST['conditions']);

    $date = date("d F Y");



    if (strlen($firstName)<2) 
    {
      $error = "First Name Is To Short";

    }
    else if (strlen($lastName)<2) 
    {
      $error ="Last Name Is Too Short";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $error = "Please Enter Valid Email Address";
    }
    else if (email_exists($email,$sylcon)) 
    {
      $error = "Someone Is Already Registered With This Account";
    }

    else if (strlen($password)<8) 
    {
      $error = "Password Must be Greater than 8 Characteres";
    }
    else if ($password !== $passwordConfirm) {
      $error = "Password Does Not Match";
    }
    else if ($image == "") 
    {
      $error = "Please Upload Your Image";
    }
    else if ($imageSize>10485760) 
          {
            $error ="Image Size Must be Less Than 10 MB";
          }
    else if(!$conditions)
    {
      $error = "You Must Be Agree With Terms And Conditions";
    }      
    else
    {

      $password = md5($password);

      $imageExt = explode(".", $image);
      $imageExtension = $imageExt[1];

      if ($imageExtension == "PNG" || $imageExtension == "png" || $imageExtension == "JPG" || $imageExtension == "jpg" || $imageExtension == "JEPG" || $imageExtension == "jepg") 
      {
       

      $image = rand(0,100000).rand(0,100000).rand(0,100000).time().".".$imageExtension ;
      


      $insertQuery = "INSERT INTO users(firstName,lastName,email,Password,image,date) VALUES ('$firstName','$lastName','$email','$password','$image','$date') " ;
      if(mysqli_query($sylcon,$insertQuery))
        {
          if (move_uploaded_file($tmp_image,"images/$image"))
          {
            $error = "You Are Succesfully Registered";
          }
          else 
          {
            $error = " Image Is Not Uploded";
          }
          
        }
      }
      else
      {
        $error ="File Must Be An Image....!";
      }

    }

    /*echo $firstName."<br/>".$lastName."<br/>".$email."<br/>".$password."<br/>".$passwordConfirm."<br/>".$image."<br/>".$imageSize ; */
  }

?>



















<!doctype html>

<html>
  <head>
    <title>WebSystem Registration Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  </head>

  <body>

     <div id="error" style="<?php if($error !=""){ ?> display:block;   <?php } ?> "><?php echo $error; ?></div>

     <div class="title"><h1>WebSystem Sign Up Form</h1></div>
     

  	<div id="wrapper">
     
      <div id="menu">
      <a href="signup.php">Sign Up</a>
      <a href="login.php">Login</a>
    </div>

  	<div id="formDiv">
  		<form method="POST" action="signup.php" enctype="multipart/form-data">
      
      <label>First Name:</label> <br/>
      <input type="text" name="fname" class="inputFields" required /> <br/><br/>

      <label>Last Name:</label> <br/>
      <input type="text" name="lname" class="inputFields" required /> <br/><br/>

      <label>Email:</label> <br/>
      <input type="text" name="email" class="inputFields" required /> <br/><br/>

      <label>Password:</label> <br/>
      <input type="password" name="password" class="inputFields" required /> <br/><br/>

      <label>Re-Enter Password:</label> <br/>
      <input type="password" name="passwordConfirm" class="inputFields" required /> <br/><br/>

      <label>Image:</label> <br/>
      <input type="file" name="image" id="imageupload" /> <br/><br/>


      <input type="checkbox" name="conditions" /> 
      <label>I am agree with terms and conditions.</label> <br/><br/>

      
      <input type="submit" name="submit" value="Submit" class="theButtons" /> <br/><br/>
  		
  			
  		</form>
  	</div>
  	</div>
  </body>

</html>