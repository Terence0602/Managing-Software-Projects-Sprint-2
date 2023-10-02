<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="utf-8" />
        <meta name="description" content="Member Records" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery - Member Records Page</title>
    </head> 
    <body>
        <nav class = "navigationbar">
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
        <?php
            $search = $_GET['name'];
        ?>
        <div id="container">
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
            if (!$conn) {
                echo "Can't connect to database.";
            }

            $SQL = "SELECT * FROM member WHERE MemberFirstName LIKE '%$search%' OR MemberLastName LIKE '%$search%'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            echo '<b>' . $result . "</b> results found for search query '$search'.";
            echo '<ul>';
            while ($row = mysqli_fetch_assoc($run)) {
                echo "<li><a href='displayMemberInfo.php?search=" . $row['MemberFirstName'] . "'>" . $row['MemberFirstName'] . " " . $row['MemberLastName'] . "</a></li>";
            }
            echo '</ul>';
            echo '</div>';
        ?>
    </body>
</html>