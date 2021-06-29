<?php
include 'config.php';

	$name=$_POST['name'];
	$email=$_POST['email'];
	$phonenumber=$_POST['phonenumber'];
	$sql="INSERT INTO applicant (name,email,phonenumber)VALUES ('$name','$email','$phonenumber')";
	$m= mysqli_query($con,$sql);	
      if($m)
         {
		  echo "Inserted";
		}

	else
		{
		 echo "error";
		}

?>
      