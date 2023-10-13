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
        session_abort();
        session_start();
        $sales_date = $selected_product = $selected_member = $quantity = "";
        $sales_date_error = $selected_product_error = $selected_member_error = $quantity_error = "";
        $valid_form = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["sales_date"])) {
                $sales_date_error = "Sales date is required";
                $valid_form = false;
            } else {
                $sales_date = $_POST["sales_date"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["selected_product"])) {
                $selected_product_error = "You must select a product";
                $valid_form = false;
            } else {
                $selected_product = $_POST["selected_product"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["selected_member"])) {
                $selected_member_error = "You must select a member";
                $valid_form = false;
            } else {
                $selected_member = $_POST["selected_member"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["quantity"]) || $_POST["quantity"] == 0) {
                $quantity_error = "Item quantity is needed and should be greater than 0";
                $valid_form = false;
            } else {
                $quantity = $_POST["quantity"];
            }
        } 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $price_per_unit = floatval($_POST["selected_product"]);
            $total_cost = (float)$quantity * $price_per_unit;
        }

        $buyer = isset($_GET['buyer']) ? $_GET['buyer'] : '';
        $item = isset($_GET['item']) ? $_GET['item'] : '';
        $sales_id = isset($_GET['sales_id']) ? $_GET['sales_id'] : '';

        $_SESSION['buyer'] = $buyer;
        $_SESSION['item'] = $item;
        $_SESSION['sales_id'] = $sales_id;
        ?>
        <div id="container">
        <?php
            $buyer = $_GET['buyer'];
            $item = $_GET['item'];
            $sales_id = $_GET['sales_id'];
        ?>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
        if (!$conn) {
            echo "Can't connect to the database.";
        }
        $SQL = "SELECT * FROM sales WHERE SalesBuyerName LIKE '%$buyer%' AND SalesItem LIKE '%$item%' AND SalesID LIKE '%$sales_id%'";
        $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $result = mysqli_num_rows($run);

        if ($result > 0) {
            $row = mysqli_fetch_assoc($run);
            echo "
            <h1 class='center'>Editing record for " . $row['SalesBuyerName'] . " - " . $row['SalesItem'] . " (" . $row['SalesQuantity'] . " units)</h1>
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
        }
        ?>
        </div>
        <div id="container">
        <form method="post" id="edit_sales" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?buyer=<?php echo urlencode($_SESSION['buyer']); ?>&item=<?php echo urlencode($_SESSION['item']); ?>&sales_id=<?php echo urlencode($_SESSION['sales_id']); ?>"> 
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
                if ($valid_form) {
                    $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                    if (!$conn) {
                        echo "Can't connect to database.";
                    }
                    $selected_product = mysqli_real_escape_string($conn, $_POST["selected_product"]);
                    $query = "SELECT ProductPricePerUnit, ProductStock FROM product WHERE ProductName = '$selected_product'";
                    $result = mysqli_query($conn, $query);
                    
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $price_per_unit = $row['ProductPricePerUnit'];
                        $available_stock = $row['ProductStock'];

                        $total_cost = (float)$quantity * $price_per_unit;
                    }

                    $buyer = $_GET['buyer'];
                    $item = $_GET['item'];
                    $sales_id = $_GET['sales_id'];
                    $SQL = "UPDATE sales SET
                    SalesSoldDate = '$sales_date',
                    SalesItem = '$selected_product',
                    SalesBuyerName = '$selected_member',
                    SalesQuantity = '$quantity',
                    SalesPrice = '$total_cost'
                    WHERE SalesBuyerName LIKE '%$buyer%' AND SalesItem LIKE '%$item%' AND SalesID LIKE '%$sales_id%'";

                    $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                    if ($run) {
                        echo '<script type="text/javascript">
                                alert("Your submission is successful.");
                                window.location.href = "sales.php";
                            </script>';
                        exit();
                    }
                    header("Location: " . $_SERVER["PHP_SELF"] . "?buyer=" . urlencode($_SESSION['buyer']) . "&item=" . urlencode($_SESSION['item']) . "?sales_id=" . urlencode($_SESSION['sales_id']));
                }
            }
            ?>
        </div>
    </body>
</html>