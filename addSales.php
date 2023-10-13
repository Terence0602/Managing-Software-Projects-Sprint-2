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
                <a class="onpage" href="addSales.php">Add Sales Record</a>
                <a href="searchSales.php">Manage Sales Records</a>
            </nav>
        </div>

        <?php

        $sales_date = $selected_product = $selected_member = $quantity = "";
        $sales_date_error = $selected_product_error = $selected_member_error = $quantity_error = "";
        $verify_date = $verify_product = $verify_member = $verify_quantity = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["sales_date"])) {
                $sales_date_error = "Sales date is required";
            } else {
                $sales_date = $_POST["sales_date"];
                $verify_date = 1;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["selected_product"])) {
                $selected_product_error = "You must select a product";
            } else {
                $selected_product = $_POST["selected_product"];
                $verify_product = 1;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["selected_member"])) {
                $selected_member_error = "You must select a member";
            } else {
                $selected_member = $_POST["selected_member"];
                $verify_member = 1;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["quantity"]) || $_POST["quantity"] == 0) {
                $quantity_error = "Item quantity is needed and should be greater than 0";
            } else {
                $quantity = $_POST["quantity"];
                $verify_quantity = 1;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            if (empty($_POST["quantity"]) || $_POST["quantity"] == 0) {
                $quantity_error = "Item quantity is needed and should be greater than 0";
            } else {
                $quantity = $_POST["quantity"];
                $verify_quantity = 1;
                $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                            if (!$conn) {
                                echo "Can't connect to the database.";
                }
                $selected_product = mysqli_real_escape_string($conn, $_POST["selected_product"]);
                $query = "SELECT ProductStock FROM product WHERE ProductName = '$selected_product'";
                $result = mysqli_query($conn, $query);
        
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $available_stock = $row['ProductStock'];
                    if ($quantity > $available_stock) {
                        $quantity_error = "Quantity exceeds available stock ($available_stock units).";
                        $verify_quantity = 0;
                    }
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $price_per_unit = floatval($_POST["selected_product"]);
            $total_cost = (float)$quantity * $price_per_unit;
        }

        ?>

        <h1 class="center">Add a new Sales record</h1>
        <div id="container">
        <form method="post" id="add_sales" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <fieldset>
                <legend>Add Sales Form</legend>
                <p>
                    <label for="sales_date">Date of Sale</label>
                    <input type="date" name="sales_date" id="sales_date" maxlength="20" size="10" placeholder="dd/mm/yyyy" value="<?php echo $sales_date;?>"/>
                    <span class="error">* <?php echo $sales_date_error;?> </span>
                </p>
                <fieldset>
                    <legend>Items</legend>
                    <select name="selected_product" id="selected_product">
                        <option value="">Select a Product</option>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                        if (!$conn) {
                            echo "Can't connect to database.";
                        }

                        $query = "SELECT ProductName, ProductPricePerUnit FROM product";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $itemName = $row['ProductName'];
                            $itemPrice = $row['ProductPricePerUnit'];
                            echo '<option value="' . $itemName . '">' . $itemName . ' ($' . $itemPrice . ' per unit)</option>';
                        }

                        mysqli_close($conn);
                        ?>
                    </select>
                <span class="error">* <?php echo $selected_product_error;?> </span>
                </fieldset>
                <fieldset>
                    <legend>Buyer Credentials:</legend>
                    <p>
                        <select name="selected_member" id="selected_member" value="<?php echo $selected_member;?>">
                        <option value="">Select a Member</option>
                        <?php
                            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                            if (!$conn) {
                                echo "Can't connect to the database.";
                            }

                            $query = "SELECT MemberFirstName, MemberLastName FROM member";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $memberFirstName = $row['MemberFirstName'];
                                $memberLastName = $row['MemberLastName'];
                                $memberFullName = $memberFirstName . ' ' . $memberLastName;
                                echo '<option value="' . $memberFullName . '">' . $memberFullName . '</option>';
                            }

                            mysqli_close($conn);
                        ?>
                        </select>
                        <span class="error">* <?php echo $selected_member_error;?> </span>
                        <br><br>
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" onchange="calculateTotalCost()" value="<?php echo $quantity;?>"/>
                        <span class="error">* <?php echo $quantity_error;?> </span>
                    </p>
                </fieldset>
                <p>
                    <label for="price">Total Cost:</label>
                    <input type="text" name="price" id="price" readonly />
                </p>
            </fieldset>
            <script>
                function calculateTotalCost() {
                    var selectedProduct = document.getElementById("selected_product");
                    var selectedIndex = selectedProduct.selectedIndex;
                    if (selectedIndex !== 0) {
                        var pricePerUnit = parseFloat(selectedProduct.options[selectedIndex].text.split('($')[1].split(' per unit)')[0]);
                        var quantity = parseInt(document.getElementById("quantity").value);
                        var totalCost = pricePerUnit * quantity;
                        document.getElementById("price").value = "$" + totalCost.toFixed(2);
                    } else {
                        document.getElementById("price").value = "";
                    }
                }
            </script>
            <br>
            <input type="submit" name="submit" class="button"></input>
            <input type="reset" value="Reset Form" />
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($verify_date == 1 && $verify_product == 1 && $verify_member == 1 && $verify_quantity == 1) {
                $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                if (!$conn) {
                    echo "Can't connect to the database.";
                }
                $selected_product = mysqli_real_escape_string($conn, $_POST["selected_product"]);
                $query = "SELECT ProductPricePerUnit, ProductStock FROM product WHERE ProductName = '$selected_product'";
                $result = mysqli_query($conn, $query);
        
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $price_per_unit = $row['ProductPricePerUnit'];
                    $available_stock = $row['ProductStock'];
        
                    if ($quantity > $available_stock) {
                        $quantity_error = "Quantity exceeds available stock ($available_stock units).";
                    } else {
                        $total_cost = (float)$quantity * $price_per_unit;
                        $updateQuery = "UPDATE product SET ProductStock = ProductStock - $quantity WHERE ProductName = '$selected_product'";
                        $updateResult = mysqli_query($conn, $updateQuery);
        
                        if ($updateResult) {
                            $SQL = "INSERT INTO sales (SalesSoldDate, SalesItem, SalesBuyerName, SalesQuantity, SalesPrice) 
                            VALUES ('$sales_date', '$selected_product', '$selected_member', '$quantity', '$total_cost')";
            
                            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                            if ($run) {
                                ?>
                                <script type="text/javascript">
                                    alert("Your submission is successful.");
                                    window.location.href = "sales.php";
                                </script>
                                <?php
                            }
                        }
                    }
                }
                mysqli_close($conn);
            }
        }
        ?>
        </div>
    </body>
</html>