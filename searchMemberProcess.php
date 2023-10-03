<?php
$search_query = $_GET['search_query'];
?>

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
        <div id="container">
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
            if (!$conn) {
                echo "Can't connect to the database.";
            }

            $SQL = "SELECT * FROM member WHERE MemberFirstName LIKE '%$search_query%' OR MemberLastName LIKE '%$search_query%'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            if ($result > 0) {
                echo "<h2 class='center'>Search Results for '$search_query'</h2>";
                echo '<ul class="menu2">';
                while ($row = mysqli_fetch_assoc($run)) {
                    echo "<li><a href='displayMemberInfo.php?fname=" . $row['MemberFirstName'] . "&lname=" . $row['MemberLastName'] . "'>" . $row['MemberFirstName'] . " " . $row['MemberLastName'] . "</a></li>";
                }
                echo '</ul>';
            } else {
                echo "No matching members found.";
            }
            ?>
        </div>
    </body>
</html>
