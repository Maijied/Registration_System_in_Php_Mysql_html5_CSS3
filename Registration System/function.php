/*Project Created By: Md.Maizied Hasan */

<?php 
     function email_exists($email, $sylcon)
     {
        $result = mysqli_query($sylcon,"SELECT id FROM users WHERE email='$email'");

        if (mysqli_num_rows($result)==1) 
        {
        	return true;
        }
        else
        {
        	return false;
        }
     }

     
     function logged_in()
     {
     	if (isset($_SESSION['email']) || isset($_COOKIES['email']) ) 
     	{
     	 return true;

     	}
     	else
     	{
     	return false;
     	}
     }

 ?>