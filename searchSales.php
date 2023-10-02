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
                <a href="addSales.php">Add Sales Record</a>
                <a class="onpage" href="searchSales.php">Manage Sales Records</a>
            </nav>
        </div>
        <h1 class = "center" >Managing Sales records</h1>
        <div id="container">
            <?php
                $name_error = "";
                $name = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    if (empty($_POST["name"])) {
                    $name_error = "Name is required";
                    }else if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])){
                        $name_error = "You can only enter letters and spaces. Please try again.";
                    }else{
                    $name = $_POST["name"];
                    header("Location: searchSalesProcess.php?name=$name");
                    }
                }
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                <h2>Please enter a search query to search for a name associated with their respective records.</h2>
                Name: <input type="text" name="name" value="<?php echo $name;?>">
                <span class="error">* <?php echo $name_error;?></span>
                <br><br>
                <input type="submit" name="submit" class="button"></input><br>
            </form>
        </div>
    </body>
</html>