<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
	$product_name= $_POST['product_name'];
	$product_stock= $_POST['product_stock'];
    $product_supply_date = $_POST['product_supply_date'];
    $product_supplier = $_POST['product_supplier'];
	$product_price_per_unit = $_POST['product_price_per_unit'];

	
	$conn = mysqli_connect('localhost','root','','gotogro-mrm');
	if(!$conn){
		echo "Can't connect to database.";
	}
    $SQL = "INSERT INTO product (ProductName, ProductStock, ProductSupplyDate, ProductSupplier, ProductPricePerUnit) 
    VALUES ('$product_name', '$product_stock', '$product_supply_date', '$product_supplier', '$product_price_per_unit')";
					
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