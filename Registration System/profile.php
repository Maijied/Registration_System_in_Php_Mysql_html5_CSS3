/*Project Created By: Md.Maizied Hasan */

<?php

    include("connect.php");
    include("function.php");
    //include("login.php");

    if(logged_in())
    {
    	
       


       
?>      
        <a href="logout.php" style="float: right; padding: 10px; margin-right: 20px; background-color: #eee; color: #333; text-decoration: none;" >Log Out</a>

        <a href="changepassword.php" style="float: right; padding: 10px; margin-right: 20px; background-color: #eee; color: #333; text-decoration: none;">Change Password</a>
        <a href="home.php" style="float: right; padding: 10px; margin-right: 20px; background-color: #eee; color: #333; text-decoration: none;">Home </a>

<?php
   }
    else
    {
    	
    	header("location:login.php");
        exit();
    }
   
?>


