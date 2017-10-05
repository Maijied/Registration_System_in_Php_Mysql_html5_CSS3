/*Project Created By: Md.Maizied Hasan */


<?php

   $sylcon = mysqli_connect("localhost","root","","registration");

   if (mysqli_connect_errno()) 
   {

   	echo "Error occured while connecting to database".mysqli_connect_errno();
   }

   session_start();

?>