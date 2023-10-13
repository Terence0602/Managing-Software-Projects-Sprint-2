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
        <div class="sidebar2">
            <nav class="vertical-nav2">
                <a href="addMember.php">Add Member Record</a>
                <a class="onpage" href="searchMember.php">Manage Member Records</a>
            </nav>
        </div>

        <?php
        session_start();

        $member_f_error = $member_l_error = $dob_error = $email_error = $number_error = $street_error = $suburb_error = $state_error = $postcode_error = "";
        $member_f = $member_l = $dob = $email = $number = $street = $suburb = $state = $postcode = $joindate = "";
        $valid_form = true;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["member_f"])) {
                $member_f_error = "Name is required";
                $valid_form = false;
            } else {
                $member_f = $_POST["member_f"];
                if (strlen($member_f) > 50) {
                    $member_f_error = "The entered name cannot exceed 50 characters. Please try again.";
                    $valid_form = false;
                }
                if(!preg_match("/^[a-zA-Z-' ]*$/",$member_f)){
                    $member_f_error = "You can only enter letters and spaces. Please try again.";
                    $valid_form = false;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["member_l"])) {
                $member_l_error = "Name is required";
                $valid_form = false;
            } else {
                $member_l = $_POST["member_l"];
                if (strlen($member_l) > 50) {
                    $member_l_error = "The entered name cannot exceed 50 characters. Please try again.";
                    $valid_form = false;
                }
                if(!preg_match("/^[a-zA-Z-' ]*$/",$member_l)){
                    $member_l_error = "You can only enter letters and spaces. Please try again.";
                    $valid_form = false;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $dob = $_POST["dob"];
        }
        if (empty($_POST["email"])) {
            $email_error = "Email is required";
            $valid_form = false;
        } else {
            $email = $_POST["email"];
            if (!preg_match("/^[A-Za-z0-9+_.-]+@(.+)$/", $email)){
                $email_error = "Invalid email domain. Please try again.";
                $valid_form = false;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["number"])) {
                $number_error = "Phone number is required";
                $valid_form = false;
            } else {
                $number = $_POST["number"];
                if (strlen($number) != 10) {
                    $number_error = "Your phone number can only have ten numbers. Please try again.";
                    $valid_form = false;
                }
                if(!preg_match("/^\d{10}$/",$number)){
                    $number_error = "You can only enter numbers with no spaces. Please try again.";
                    $valid_form = false;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["street"])) {
                $street_error = "Street address is required";
                $valid_form = false;
            } else {
                $street = $_POST["street"];
                if (strlen($street) > 100) {
                    $street_error = "The entered street address cannot exceed 100 characters. Please try again.";
                    $valid_form = false;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["suburb"])) {
                $suburb_error = "Suburb is required";
                $valid_form = false;
            } else {
                $suburb = $_POST["suburb"];
                if (strlen($suburb) > 30) {
                    $suburb_error = "The entered suburb cannot exceed 30 characters. Please try again.";
                    $valid_form = false;
                }
                if(!preg_match("/^[a-zA-Z-' ]*$/",$suburb)){
                    $suburb_error = "You can only enter letters and spaces. Please try again.";
                    $valid_form = false;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["state"])) {
                $state_error = "State is required";
                $valid_form = false;
            } else {
                $state = $_POST["state"];
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["postcode"])) {
                $postcode_error = "Postcode is required";
                $valid_form = false;
            } else {
                $postcode = $_POST["postcode"];
                if (strlen($postcode) != 4) {
                    $postcode_error = "The entered postcode must have 4 characters. Please try again.";
                    $valid_form = false;
                }
                if(!preg_match("/^\d{4}$/",$postcode)){
                    $postcode_error = "You can only enter numbers with no spaces. Please try again.";
                    $valid_form = false;
                }
            }
        }
        $fname = isset($_GET['fname']) ? $_GET['fname'] : '';
        $lname = isset($_GET['lname']) ? $_GET['lname'] : '';
        $member_id = isset($_GET['member_id']) ? $_GET['member_id'] : '';

        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['member_id'] = $member_id;
        ?>
        <div id="container">
        <?php
            $fname = $_GET['fname'];
            $lname = $_GET['lname'];
        ?>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
            if (!$conn) {
                echo "Can't connect to the database.";
            }
            $SQL = "SELECT * FROM member WHERE MemberFirstName LIKE '%$fname%' AND MemberLastName LIKE '%$lname%'";
            $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            $result = mysqli_num_rows($run);

            if ($result > 0) {
                $row = mysqli_fetch_assoc($run);
                echo "
                <h1 class='center'>Editing record for " . $row['MemberFirstName'] . " " . $row['MemberLastName'] . "</h1>
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
            }
        ?>
        </div>
        <div id="container">
        <form method="post" id="edit_member" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?fname=<?php echo urlencode($_SESSION['fname']); ?>&lname=<?php echo urlencode($_SESSION['lname']); ?>&member_id=<?php echo urlencode($_SESSION['member_id']); ?>"> 
                <fieldset>
                    <legend>Please fill in all fields below.</legend>
                    <fieldset>
                        <p>
                            <label for="member_f">First name</label>
                            <input type="text" name="member_f" id="member_f" size="50" value="<?php echo $member_f;?>"/>
                            <span class="error">* <?php echo $member_f_error;?> </span>
                            <br><br>
                            <label for="member_l">Last name</label>
                            <input type="text" name="member_l" id="member_l" size="50" value="<?php echo $member_l;?>" />
                            <span class="error">* <?php echo $member_l_error;?> </span>
                        </p>
                    </fieldset>
                    <p>
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" placeholder="dd/mm/yyyy" value="<?php echo $dob;?>" />
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" size="30" value="<?php echo $email;?>" >
                        <span class="error">* <?php echo $email_error;?> </span>
                    </p>
                    <p>
                        <label for="number">Phone Number</label>
                        <input type="text" id="number" name="number" size="10" value="<?php echo $number;?>" />
                        <span class="error">* <?php echo $number_error;?> </span>
                    </p>
                    <fieldset>
                        <p>
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" value="<?php echo $street;?>" />
                            <span class="error">* <?php echo $street_error;?> </span>
                            <br><br>
                            <label for="suburb">Suburb</label>
                            <input type="text" id="suburb" name="suburb" value="<?php echo $suburb;?>" />
                            <span class="error">* <?php echo $suburb_error;?> </span>
                            <br><br>
                            <label for="state">State</label>
                            <select name="state" id="state" value="<?php echo $state;?>" >
                                <option value="">Please Select</option>
                                <option value="VIC">VIC</option>
                                <option value="NSW">NSW</option>
                                <option value="QLD">QLD</option>
                                <option value="NT">NT</option>
                                <option value="WA">WA</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="ACT">ACT</option>
                            </select>
                            <span class="error">* <?php echo $state_error;?> </span>
                        </p>
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode" size="4" value="<?php echo $postcode;?>" />
                        <span class="error">* <?php echo $postcode_error;?> </span>
                    </fieldset>
                    <br>
                <input type="submit" name="submit" class="button"></input>
                <input type="reset" value="Reset Form" />
                </fieldset>
            </form>
            <?php
            if($valid_form){
                $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                if (!$conn) {
                    echo "Can't connect to database.";
                }
                $fname = $_GET['fname'];
                $lname = $_GET['lname'];
                $member_id = $_GET['member_id'];
                $SQL = "UPDATE member SET 
                MemberFirstName = '$member_f',
                MemberLastName = '$member_l',
                MemberDateOfBirth = '$dob',
                MemberEmail = '$email',
                MemberPhone = '$number',
                MemberAddress = '$street',
                MemberSuburb = '$suburb',
                MemberState = '$state',
                MemberPostcode = '$postcode'
                WHERE MemberFirstName LIKE '%$fname%' AND MemberLastName LIKE '%$lname%' AND MemberID LIKE '%$member_id%'";

                $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                if($run){?>
                    <script type="text/javascript">
                        alert("Your submission is successful.");
                        window.location.href = "member.php";
                    </script>
                        <?php
                }
                header("Location: " . $_SERVER["PHP_SELF"] . "?fname=" . urlencode($_SESSION['fname']) . "&lname=" . urlencode($_SESSION['lname']) . "&member_id=" . urlencode($_SESSION['member_id']));
            }
            ?>
        </div>
    </body>
</html>