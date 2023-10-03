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
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        ?>
        <div id="container">
        <?php
            $conn = mysqli_connect('localhost','root','','gotogro-mrm');
            if(!$conn){
                echo "Can't connect to database.";
            }
            $SQL = "SELECT * FROM member WHERE MemberFirstName LIKE '%$fname%' AND MemberLastName LIKE '%$lname%'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            if ($result > 0) {
                $row = mysqli_fetch_assoc($run);
                echo "
                <h1 class='center'>Record for " . $row['MemberFirstName'] . " " . $row['MemberLastName'] . "</h1>
                <hr class='divider'>
                <ul>
                    <li>Member ID: " . $row['MemberID'] . "</li>
                    <li>First Name: " . $row['MemberFirstName'] . "</li>
                    <li>Last Name: " . $row['MemberLastName'] . "</li>
                    <li>Date of Birth: " . $row['MemberDateOfBirth'] . "</li>
                    <li>Email: " . $row['MemberEmail'] . "</li>
                    <li>Phone: " . $row['MemberPhone'] . "</li>
                    <li>Address: " . $row['MemberAddress'] . "</li>
                    <li>Suburb: " . $row['MemberSuburb'] . "</li>
                    <li>State: " . $row['MemberState'] . "</li>
                    <li>Postcode: " . $row['MemberPostcode'] . "</li>
                    <li>Date Joined: " . $row['MemberJoinDate'] . "</li>
                </ul>
                ";

                echo "<a href='confirmMemberDelete.php?updatename=" . $row['MemberFirstName'] . "&member_id=" . $row['MemberID'] . "'><button>Delete Member</button></a><br><br>";
                echo "<a href='editMember.php?updatename=" . $row['MemberFirstName'] . "'><button>Update Member Credentials</button></a>";
                echo "</div>";
            }
        ?>
    </body>
</html>