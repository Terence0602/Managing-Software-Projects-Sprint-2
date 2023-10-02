<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
	$member_f= $_POST['member_f'];
	$member_l= $_POST['member_l'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $street = $_POST['street'];
    $suburb = $_POST['suburb'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];

	
	$conn = mysqli_connect('localhost','root','','gotogro-mrm');
	if(!$conn){
		echo "Can't connect to database.";
	}
    $SQL = "INSERT INTO member (MemberFirstName, MemberLastName, MemberDateOfBirth, MemberEmail, 
    MemberPhone, MemberAddress, MemberSuburb, MemberState, MemberPostcode, MemberJoinDate) 
    VALUES ('$member_f', '$member_l', '$dob', '$email', '$number', '$street', '$suburb', '$state', '$postcode', NOW())";

					
    $run = mysqli_query($conn, $SQL)or die(mysqli_error($conn));
	
    if($run){?>
	<script type="text/javascript">
		alert("Submission successful."); 
    </script>
		<?php
	}else{?>
		<script type="text/javascript">
        alert("Sorry, your submission has failed. Please check your information before submitting again."); 
		</script>
		<?php	
					}
        
	?>
        <h1>Submission successful.</h1>
        <a href="Home.php">Click here to return to the main menu.</a>
    </body>
</html>