<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="utf-8" />
    <meta name="description" content="Member Records" />
    <link rel="stylesheet" href="./css/style.css">
    <title>Goto Grocery - Member Records Page</title>
</head> 
<body>
    <nav class="navigationbar">
        <a href="Home.php">Home</a>
        <a class="onpage" href="member.php">Member Records</a>
        <a href="product.php">Product Records</a>
        <a href="sales.php">Sales Records</a>
    </nav>
    <br>
    <div class="sidebar">
        <nav class="vertical-nav">
            <a href="addMember.php">Add Member Record</a>
            <a class="onpage" href="searchMember.php">Manage Member Records</a>
        </nav>
    </div>
    <h1 class="center">Managing member records</h1>
    <div id="container">
        <?php
        $search_query_error = "";
        $search_query = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["search_query"])) {
                $search_query_error = "Name is required";
            } else if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["search_query"])) {
                $search_query_error = "You can only enter letters and spaces. Please try again.";
            } else {
                $search_query = $_POST["search_query"];
                header("Location: searchMemberProcess.php?search_query=$search_query");
            }
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
            <h2>Please enter a search query to search for names associated with their respective records.</h2>
            Name: <input type="text" name="search_query" value="<?php echo $search_query; ?>">
            <span class="error">* <?php echo $search_query_error; ?></span>
            <br><br>
            <input type="submit" name="submit" class="button"></input><br><br>
        </form>

        <a href="exportAllMembers.php"><button>Export All Member Records</button></a>
    </div>
</body>
</html>
