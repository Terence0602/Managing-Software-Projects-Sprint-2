<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
	$member_id = $_GET['member_id'];
	
	$conn = mysqli_connect('localhost','root','','gotogro-mrm');
	if(!$conn){
		echo "Can't connect to database.";
	}
    $SQL = "DELETE FROM member where MemberID = '$member_id'";

					
    $run = mysqli_query($conn, $SQL)or die(mysqli_error($conn));
	
    if($run){?>
		<script type="text/javascript">
			alert("Member successfully deleted.");
			window.location.href = "member.php";
		</script>
		<?php
	}else{?>
		<script type="text/javascript">
			alert("Deletion failed. Please try again.");
			window.location.href = "member.php";
		</script>
		<?php	
	}
        
	?>
        <h1>Submission successful.</h1>
        <a href="Home.php">Click here to return to the main menu.</a>
    </body>
</html>