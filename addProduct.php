<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Product Records" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery - Product Records Page</title>
    </head>
    <body>
        <header>
            <a href="Home.php"><h1>Goto Grocery</h1></a>
            <hr />
            <nav>
                <a href="member.php">Member Records</a>
                <a href="product.php">Product Records</a>
                <a href="sales.php">Sales Records</a>
            </nav>
            <hr />
        </header>
        <h1>Product Records Page</h1>
        <hr />
        <nav>
            <a href="addProduct.php">Add Product Record</a>
            <a href="editProduct.php">Edit Product Record</a>
            <a href="deleteProduct.php">Delete Product Record</a>
            <a href="searchProduct.php">Search Product Record</a>
        </nav>
        <hr />
        <h3>Add Product Form</h3>
        <form id="product_R" method="post" action="product_process.php">
            <fieldset>
                <legend>Add Product Form</legend>
                <p>
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" id="product_name" maxlength="40" size="20" required="required" placeholder="Product Name" />
                    <br><br>
                    <label for="product_stock">Product Stock:</label>
                    <input type="number" name="product_stock" id="product_stock" maxlength="40" size="20" required="required" placeholder="Product Stock" />
                    <br><br>
                    <label for="product_supply_date">Product Supply Date:</label>
                    <input type="date" name="product_supply_date" id="product_supply_date" maxlength="40" size="20" required="required" placeholder="Product Supply Date" />
                    <br><br>
                    <label for="product_supplier">Product Supplier:</label>
                    <input type="text" name="product_supplier" id="product_supplier" maxlength="40" size="20" required="required" placeholder="Product Supplier" />
                    <br><br>
                    <label for="product_price_per_unit">Product Price Per Unit:</label>
                    $<input type="number" step="0.01" name="product_price_per_unit" id="product_price_per_unit" maxlength="40" size="20" required="required" placeholder="Product Price Per Unit" />
                    <br><br>
                </p>
            <input type="submit" value="Submit" />
            <input type="reset" value="Reset Form" />
        </form>
        <hr />
        <p>This section will update depending on if its an existing product and the given values.</p>
        <h3>Stock on hand:</h3>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
            if (!$conn) {
                echo "Can't connect to database.";
            }

            $query = "SELECT ProductName, ProductStock FROM product";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $itemName = $row['ProductName'];
                $itemStock = $row['ProductStock'];
                echo '<p>' . $itemName . ' (' . $itemStock . ' left in stock)</>';
            }

            mysqli_close($conn);
        ?>
        <hr/>
        <h3>Product incoming</h3>
        <p> ------ </p>
        <hr />
    </body>
</html>