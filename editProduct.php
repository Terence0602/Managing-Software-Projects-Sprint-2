<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="utf-8" />
    <meta name="description" content="Product Records" />
    <link rel="stylesheet" href="./css/style.css">
    <title>Goto Grocery - Product Records Page</title>
</head> 
<body>
    <nav class="navigationbar">
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
        session_abort();
        session_start();

        $product_name = $product_stock = $product_supply_date = $product_supplier = $product_price_per_unit = "";
        $product_name_error = $product_stock_error = $product_supply_date_error = $product_supplier_error = $product_price_per_unit_error = "";
        $verify_name = $verify_stock = $verify_supply_date = $verify_supplier = $verify_price_per_unit = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_name"])) {
                $product_name_error = "Product name is required";
            } else {
                $product_name = $_POST["product_name"];
                $verify_name = 1;
                if (strlen($product_name) > 50) {
                    $product_name_error = "The entered product name cannot exceed 50 characters. Please try again.";
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_stock"])) {
                $product_stock_error = "Stock quantity is required";
            } else {
                $product_stock = $_POST["product_stock"];
                $verify_stock = 1;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_supply_date"])) {
                $product_supply_date_error = "Supply date is required";
            } else {
                $product_supply_date = $_POST["product_supply_date"];
                $verify_supply_date = 1;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_supplier"])) {
                $product_supplier_error = "Product supplier is required";
            } else {
                $product_supplier = $_POST["product_supplier"];
                $verify_supplier = 1;
                if (strlen($product_supplier) > 50) {
                    $product_supplier_error = "The entered product supplier cannot exceed 50 characters. Please try again.";
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["product_price_per_unit"])) {
                $product_price_per_unit_error = "The price per unit of the product is required";
            } else {
                $product_price_per_unit = $_POST["product_price_per_unit"];
                $verify_price_per_unit = 1;
            }
        }

        $pname = isset($_GET['pname']) ? $_GET['pname'] : '';
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';

        $_SESSION['pname'] = $pname;
        $_SESSION['product_id'] = $product_id;
        ?>
        <div id="container">
        <?php
            $pname = $_GET['pname'];
            $product_id = $_GET['product_id'];
        ?>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
        if (!$conn) {
            echo "Can't connect to the database.";
        }
        $SQL = "SELECT * FROM product WHERE ProductName LIKE '%$pname%' AND ProductID LIKE '%$product_id%'";
        $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $result = mysqli_num_rows($run);

        if ($result > 0) {
            $row = mysqli_fetch_assoc($run);
            echo "
            <h1 class='center'>Editing record for " . $row['ProductName'] . "</h1>
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
            }
        ?>
        </div>
        <div id="container">
        <form method="post" id="add_product" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?pname=<?php echo urlencode($_SESSION['pname']); ?>&product_id=<?php echo urlencode($_SESSION['product_id']); ?>"> 
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
            if($verify_name = $verify_stock = $verify_supply_date = $verify_supplier = $verify_price_per_unit == 1){
                $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                if (!$conn) {
                    echo "Can't connect to database.";
                }
                $pname = $_GET['pname'];
                $product_id = $_GET['product_id'];
                $SQL = "UPDATE product SET
                ProductName = '$product_name',
                ProductStock = '$product_stock',
                ProductSupplyDate = '$product_supply_date',
                ProductSupplier = '$product_supplier',
                ProductPricePerUnit = '$product_price_per_unit'
                WHERE ProductName LIKE '%$pname%' AND ProductID LIKE '%$product_id%'";

                $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                if ($run) {
                    echo '<script type="text/javascript">
                            alert("Your submission is successful.");
                            window.location.href = "product.php";
                          </script>';
                    exit();
                }
                header("Location: " . $_SERVER["PHP_SELF"] . "?pname=" . urlencode($_SESSION['pname']) . "&product_id=" . urlencode($_SESSION['product_id']));
            }
            ?>
        </div>
    </body>
</html>