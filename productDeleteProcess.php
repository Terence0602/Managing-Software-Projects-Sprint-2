<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
	$pname = $_GET['pname'];
    $product_id = $_GET['product_id'];
	
	$conn = mysqli_connect('localhost','root','','gotogro-mrm');
	if(!$conn){
		echo "Can't connect to database.";
	}
    $SQL = "DELETE FROM product WHERE ProductName LIKE '%$pname%' AND ProductID LIKE '$product_id'";

					
    $run = mysqli_query($conn, $SQL)or die(mysqli_error($conn));
	
    if($run){?>
		<script type="text/javascript">
			alert("Product successfully deleted.");
			window.location.href = "product.php";
		</script>
		<?php
	}else{?>
		<script type="text/javascript">
			alert("Deletion failed. Please try again.");
			window.location.href = "product.php";
		</script>
		<?php	
	}
        
	?>
        <h1>Submission successful.</h1>
        <a href="Home.php">Click here to return to the main menu.</a>
    </body>
</html>