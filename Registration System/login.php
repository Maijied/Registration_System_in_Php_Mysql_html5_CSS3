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
    
    $email = mysql_real_escape_string($_POST['email']);
    $password =mysql_real_escape_string( $_POST['password']);
    $checkBox = isset($_POST['Keep']);
    
    if (email_exists($email,$sylcon)) 
    {
       

      $result = mysqli_query($sylcon,"SELECT password FROM users WHERE email = '$email'");
      $retrievepassword = mysqli_fetch_assoc($result);
      
      if (md5($password) !== $retrievepassword['password']) 
      {
         $error = "Password Is Incorrect";
      }
      else
      {
  
        $_SESSION['email'] = $email;
        
        if ($checkBox=='on') 
        {
          setcookie("email",$email,time()+3600);
        }


        header("location: profile.php");
      }

      
    }
    else
    {
      $error = "Email Does Not Exixts";
    }
  }

?>



<!doctype html>

<html>
  <head>
    <title>WebSystem Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  </head>

  <body>

     <div id="error"  style="<?php if($error !=""){ ?> display:block;   <?php } ?> "><?php echo $error; ?></div>
    
    <div class="title"><h1>WebSystem Sign In Form</h1></div>
     

     

    <div id="wrapper">
    <div id="menu">
      <a href="signup.php">Sign Up</a>
      <a href="login.php">Login</a>
    </div>
    <div id="formDiv">
      <form method="POST" action="login.php">
      
      <label>Email:</label> <br/>
      <input type="text" name="email" class="inputFields" required /> <br/><br/>

      <label>Password:</label> <br/>
      <input type="password" name="password" class="inputFields" required /> <br/><br/>
      
      <input type="checkbox" name="Keep" />
      <label>Keep me logged in</label> <br/><br/>
      
      
      <input type="submit" name="submit"  value="Log In" class="theButtons" /> <br/><br/>
      
        
      </form>
    </div>
    </div>
  </body>

</html>