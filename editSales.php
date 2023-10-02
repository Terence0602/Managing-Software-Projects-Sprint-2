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
            <a href="searchSales.php">Search Sales Records</a>
        </nav>
        <h3>Edit Sales Page</h3>
        <p>To search for a Sales record to edit, please enter a search query below.</p>
        <form action="search_results/edit_sales_search_results.php" method="GET">
            <input type="text" name="query" placeholder="Enter a query.">
            <input type="submit" value="Search">
        </form>
        <hr />
    </body>
</html>