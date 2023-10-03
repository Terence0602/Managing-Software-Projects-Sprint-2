<?php
$sname = $_GET['name'];
?>

<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8" />
        <meta name="description" content="Product Records" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery - Product Records Page</title>
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
            $search = $_GET['name'];
        ?>
        <div id="container">
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
            if (!$conn) {
                echo "Can't connect to database.";
            }

            $SQL = "SELECT * FROM product WHERE ProductName LIKE '%$search%'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            echo '<b>' . $result . "</b> results found for search query '$search'.";
            echo '<ul>';
            while ($row = mysqli_fetch_assoc($run)) {
                echo "<li><a href='displayProductInfo.php?search=" . $row['ProductName'] . "'>" . $row['ProductName'] . "</a></li>";
            }
            echo '</ul>';
            echo '</div>';
        ?>
    </body>
</html>