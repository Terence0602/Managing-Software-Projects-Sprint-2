<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php 
	$sales_date = $_POST['sales_date'];
    $selected_product = $_POST['selected_product'];
    $selected_member = $_POST['selected_member'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $selectedProduct = $_POST['selected_product'];
    list($productName, $pricePerUnit) = explode(',', $selectedProduct);
    $productName = trim($productName);
    $pricePerUnit = floatval($pricePerUnit);
    $calculatedprice = $pricePerUnit * $quantity;
	
	$conn = mysqli_connect('localhost','root','','gotogro-mrm');
	if(!$conn){
		echo "Can't connect to database.";
	}
    $SQL = "INSERT INTO sales (SalesSoldDate, SalesItem, SalesBuyerName, SalesQuantity, SalesPrice) 
    VALUES ('$sales_date', '$productName', '$selected_member', '$quantity', '$calculatedprice')";
					
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