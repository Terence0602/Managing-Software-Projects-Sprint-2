<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Sales Records" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery - Sales Records Page</title>
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
        <h1>Sales Records Page</h1>
        <hr />
        <nav>
            <a href="addSales.php">Add Sales Record</a>
            <a href="editSales.php">Edit Sales Record</a>
            <a href="deleteSales.php">Delete Sales Record</a>
            <a href="searchSales.php">Search Sales Record</a>
        </nav>
        <h3>Add Sales Record</h3>
        <hr />
        <form id="sales_R" method="post" action="sales_process.php">
            <fieldset>
                <legend>Add Sales Form</legend>
                <p>
                    <label for="sales_date">Date of Sale</label>
                    <input type="date" name="sales_date" id="sales_date" maxlength="20" size="10" required="required" placeholder="dd/mm/yyyy"/>
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
                            echo '<option value="' . $itemName . ',' . $itemPrice . '">' . $itemName . ' ($' . $itemPrice . ' per unit)</option>';
                        }

                        mysqli_close($conn);
                    ?>
                </select>
                </fieldset>
                <fieldset>
                    <legend>Buyer Credentials:</legend>
                    <p>
                        <select name="selected_member" id="selected_member">
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
                        <br><br>
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" min="1" value="1" required="required" onchange="calculateTotalCost()" />
                    </p>
                </fieldset>
                <p>
                    <label for="price">Total Cost:</label>
                    <input type="text" name="price" id="price" readonly />
                </p>
            </fieldset>
            <script>
                function calculateTotalCost() {
                    var selectedProduct = document.getElementById("selected_product").value;
                    var pricePerUnit = parseFloat(selectedProduct.split(",")[1]);
                    var quantity = parseInt(document.getElementById("quantity").value);
                    var totalCost = pricePerUnit * quantity;
                    document.getElementById("price").value = "$" + totalCost.toFixed(2);
                }
            </script>
            <br>
            <input type="submit" value="Submit" />
            <input type="reset" value="Reset Form" />
        </form>
    </body>
</html>