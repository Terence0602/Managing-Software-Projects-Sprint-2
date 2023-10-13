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
                <a class="onpage" href="addProduct.php">Add Product Record</a>
                <a href="searchProduct.php">Manage Product Records</a>
            </nav>
        </div>
        <?php

        $product_name = $product_stock = $product_supply_date = $product_supplier = $product_price_per_unit = "";
        $product_name_error = $product_stock_error = $product_supply_date_error = $product_supplier_error = $product_price_per_unit_error = "";
        $valid_form = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_name"])) {
                $product_name_error = "Product name is required";
                $valid_form = false;
            } else {
                $product_name = $_POST["product_name"];
                if (strlen($product_name) > 50) {
                    $product_name_error = "The entered product name cannot exceed 50 characters. Please try again.";
                    $valid_form = false;
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_stock"])) {
                $product_stock_error = "Stock quantity is required";
                $valid_form = false;
            } else {
                $product_stock = $_POST["product_stock"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_supply_date"])) {
                $product_supply_date_error = "Supply date is required";
                $valid_form = false;
            } else {
                $product_supply_date = $_POST["product_supply_date"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_supplier"])) {
                $product_supplier_error = "Product supplier is required";
                $valid_form = false;
            } else {
                $product_supplier = $_POST["product_supplier"];
                if (strlen($product_supplier) > 50) {
                    $product_supplier_error = "The entered product supplier cannot exceed 50 characters. Please try again.";
                    $valid_form = false;
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_price_per_unit"])) {
                $product_price_per_unit_error = "The price per unit of the product is required";
                $valid_form = false;
            } else {
                $product_price_per_unit = $_POST["product_price_per_unit"];
            }
        }

        ?>
        <h1 class="center">Add a new product record</h1>
        <div id="container">
        <form method="post" id="add_product" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <fieldset>
                <legend>Add Product Form</legend>
                <p>
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" id="product_name" maxlength="50" size="50" placeholder="Product Name" value="<?php echo $product_name;?>"/>
                    <span class="error">* <?php echo $product_name_error;?> </span>
                    <br><br>
                    <label for="product_stock">Product Stock:</label>
                    <input type="number" name="product_stock" id="product_stock" maxlength="40" size="20" placeholder="Product Stock" value="<?php echo $product_stock;?>"/>
                    <span class="error">* <?php echo $product_stock_error;?> </span>
                    <br><br>
                    <label for="product_supply_date">Product Supply Date:</label>
                    <input type="date" name="product_supply_date" id="product_supply_date" maxlength="40" size="20" placeholder="Product Supply Date" value="<?php echo $product_supply_date;?>"/>
                    <span class="error">* <?php echo $product_supply_date_error;?> </span>
                    <br><br>
                    <label for="product_supplier">Product Supplier:</label>
                    <input type="text" name="product_supplier" id="product_supplier" maxlength="50" size="50" placeholder="Product Supplier" value="<?php echo $product_supplier;?>"/>
                    <span class="error">* <?php echo $product_supplier_error;?> </span>
                    <br><br>
                    <label for="product_price_per_unit">Product Price Per Unit:</label>
                    $<input type="number" step="0.01" name="product_price_per_unit" id="product_price_per_unit" maxlength="40" size="20" placeholder="Product Price Per Unit" value="<?php echo $product_price_per_unit;?>"/>
                    <span class="error">* <?php echo $product_price_per_unit_error;?> </span>
                    <br><br>
                </p>
            <input type="submit" name="submit" class="button"></input>
            <input type="reset" value="Reset Form" />
        </form>
        <?php

        function dupeProductName($product_name){
            $conn = mysqli_connect('localhost','root','','gotogro-mrm');
            if(!$conn){
                echo "Can't connect to database.";
            }
            $product_name = mysqli_real_escape_string($conn, $product_name);
            $sql_product_name = "SELECT * FROM product WHERE ProductName = '$product_name'";
            $result = mysqli_query($conn, $sql_product_name);
            if (mysqli_num_rows($result) == 0){
                return true;
            }else{
            return false;
            }
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if($valid_form){
                if (dupeProductName($_POST['product_name'])) {
                    $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                    if (!$conn) {
                        echo "Can't connect to database.";
                    }
                    $SQL = "INSERT INTO product (ProductName, ProductStock, ProductSupplyDate, ProductSupplier, ProductPricePerUnit) 
                    VALUES ('$product_name', '$product_stock', '$product_supply_date', '$product_supplier', '$product_price_per_unit')";

                    $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                    if($run){?>
                        <script type="text/javascript">
                            alert("Your submission is successful.");
                            window.location.href = "product.php";
                        </script>
                            <?php
                    }
                } else {
                    ?>
                        <script type="text/javascript">
                            alert("Duplicate product name detected. Please try again.");
                        </script>
                    <?php
                }
            }
        }
        ?>
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
        </div>
    </body>
</html>