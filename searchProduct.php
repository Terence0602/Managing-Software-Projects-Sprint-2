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
        <h3>Search Product Page</h3>
        <p>To search for a product record, please enter a search query below.</p>
        <form action="search_results/search_product_search_results.php" method="GET">
            <input type="text" name="query" placeholder="Enter a query.">
            <input type="submit" value="Search">
        </form>
        <hr />
    </body>
</html>