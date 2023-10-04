<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
	$buyer = $_GET['buyer'];
    $item = $_GET['item'];
    $sales_id = $_GET['sales_id'];
	
	$conn = mysqli_connect('localhost','root','','gotogro-mrm');
	if(!$conn){
		echo "Can't connect to database.";
	}
    $SQL = "DELETE FROM sales WHERE SalesBuyerName LIKE '%$buyer%' AND SalesItem LIKE '%$item%' AND SalesID LIKE '%$sales_id%'";

					
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