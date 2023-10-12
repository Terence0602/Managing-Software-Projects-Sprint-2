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
    $pname = $_GET['pname'];
    ?>
    <div id="container">
    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
        if (!$conn) {
            echo "Can't connect to the database.";
        }
        $SQL = "SELECT * FROM product WHERE ProductName LIKE '%$pname%'";
        $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        $result = mysqli_num_rows($run);

        if ($result > 0) {
            $row = mysqli_fetch_assoc($run);
            echo "
            <h1 class='center'>Record for " . $row['ProductName'] . "</h1>
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

            echo "<button id='exportProductCSV'>Export Product CSV</button><br><br>";
            echo "<a href='confirmProductDelete.php?pname=" . $row['ProductName'] . "&product_id=" . $row['ProductID'] . "'><button>Delete Product</button></a><br><br>";
            echo "<a href='editProduct.php?pname=" . $row['ProductName'] . "&product_id=" . $row['ProductID'] . "'><button>Edit Product</button></a>";
            echo "</div>";
        }
    ?>
    </body>
</html>
<script>
    document.getElementById("exportProductCSV").addEventListener("click", function() {
        var pname = "<?php echo $pname; ?>";

        fetch("exportPCSV.php?pname=" + pname, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "export_csv=1",
        })
        .then(function(response) {
            return response.blob();
        })
        .then(function(blob) {
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement("a");
            a.href = url;
            a.download = "exported_product.csv";
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(function(error) {
            console.error("Export failed:", error);
        });
    });
</script>
