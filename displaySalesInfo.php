<!DOCTYPE html> 
<html lang="en"> 
<head> 
        <meta charset="utf-8" />
        <meta name="description" content="Sales Records" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery - Sales Records Page</title>
    </head> 
    <body>
        <nav class = "navigationbar">
            <a href="Home.php">Home</a>
            <a href="member.php">Member Records</a>
            <a href="product.php">Product Records</a>
            <a class="onpage" href="sales.php">Sales Records</a>
        </nav>
        <br>
        <div class="sidebar">
            <nav class="vertical-nav">
                <a href="addSales.php">Add Sales Record</a>
                <a class="onpage" href="searchSales.php">Manage Sales Records</a>
            </nav>
        </div>
        <?php
        $buyer = $_GET['buyer'];
        $item = $_GET['item'];
        $sales_id = $_GET['sales_id'];
        ?>
        <div id="container">
        <?php
            $conn = mysqli_connect('localhost','root','','gotogro-mrm');
            if(!$conn){
                echo "Can't connect to database.";
            }
            $SQL = "SELECT * FROM sales WHERE SalesBuyerName LIKE '%$buyer%' AND SalesItem LIKE '%$item%' AND SalesID LIKE '%$sales_id%'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            if ($result > 0) {
                $row = mysqli_fetch_assoc($run);
                echo "
                <h1 class='center'>Record for " . $row['SalesBuyerName'] . " - ". $row['SalesItem'] ." (". $row['SalesQuantity'] ." units)</h1>
                <hr class='divider'>
                <ul>
                    <li>Sales ID: " . $row['SalesID'] . "</li>
                    <li>Date Sold: " . $row['SalesSoldDate'] . "</li>
                    <li>Item Sold: " . $row['SalesItem'] . "</li>
                    <li>Buyer Name: " . $row['SalesBuyerName'] . "</li>
                    <li>Quantity: " . $row['SalesQuantity'] . "</li>
                    <li>Total Price: $" . $row['SalesPrice'] . "</li>
                </ul>
                ";

                echo "<a href='confirmSalesDelete.php?buyer=" . $row['SalesBuyerName'] . "&item=" . $row['SalesItem'] ."&sales_id=" . $row['SalesID'] . "'><button>Delete Sale</button></a><br><br>";
                echo "<a href='editSales.php?buyer=" . $row['SalesBuyerName'] . "&item=" . $row['SalesItem'] ."&sales_id=" . $row['SalesID'] . "'><button>Update Sale Credentials</button></a>";
                echo "</div>";
            }
        ?>
    </body>
</html>