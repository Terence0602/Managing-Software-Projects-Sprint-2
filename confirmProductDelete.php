<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8" />
        <meta name="description" content="Member Records" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery - Member Records Page</title>
    </head> 
    <body>
        <nav class = "navigationbar">
            <a href="Home.php">Home</a>
            <a href="member.php">Member Records</a>
            <a class="onpage" href="product.php">Product Records</a>
            <a href="sales.php">Sales Records</a>
        </nav>
        <br>
        <div class="sidebar">
            <nav class="vertical-nav">
                <a href="addProduct.php">Add Product Record</a>
                <a class="onpage" href="searchProduct.php">Manage Product Records</a>
            </nav>
        </div>
        <?php
        $pname = $_GET['pname'];
        $product_id = $_GET['product_id'];
        ?>
        <div id="container">
        <?php
            $conn = mysqli_connect('localhost','root','','gotogro-mrm');
            if(!$conn){
                echo "Can't connect to database.";
            }
            $SQL = "SELECT * FROM product WHERE ProductName LIKE '%$pname%' AND ProductID LIKE '$product_id'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            if ($result > 0) {
                $row = mysqli_fetch_assoc($run);
                echo "
                <h1 class='center'>Are you sure you want to delete this record for " . $row['ProductName'] . "?</h1>
                <h2 class='center'>Please review the details below again before confirming. This process is irreversible.</h2>
                <hr class='divider'>
                <ul>
                    <li>Product ID: " . $row['ProductID'] . "</li>
                    <li>Product Name: " . $row['ProductName'] . "</li>
                    <li>Product Stock: " . $row['ProductStock'] . "</li>
                    <li>Product Supply Date: " . $row['ProductSupplyDate'] . "</li>
                    <li>Product Supplier: " . $row['ProductSupplier'] . "</li>
                    <li>Product Price Per Unit: $" . $row['ProductPricePerUnit'] . "</li>
                </ul>
                ";

                echo "<a href='productDeleteProcess.php?pname=" . $row['ProductName'] . "&product_id=" . $row['ProductID'] . "'><button>Delete Member</button></a><br><br>";
                echo "<a href='searchProduct.php'><button>Cancel</button></a>";
                echo "</div>";
            }
        ?>
    </body>
</html>