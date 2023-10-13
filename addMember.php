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
                <a class="onpage" href="addMember.php">Add Member Record</a>
                <a href="searchMember.php">Manage Member Records</a>
            </nav>
        </div>

        <?php

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
        ?>

        <h1 class = "center" >Add a new member record</h1>
        <div id="container">
            <form method="post" id="add_member" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
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
            function dupeEmail($email){
                $conn = mysqli_connect('localhost','root','','gotogro-mrm');
                if(!$conn){
                    echo "Can't connect to database.";
                }
                $email = mysqli_real_escape_string($conn, $email);
                $sql_email = "SELECT * FROM member WHERE MemberEmail = '$email'";
                $result = mysqli_query($conn, $sql_email);
                if (mysqli_num_rows($result) == 0){
                    return true;
                }else{
                  return false;
                }
            }
            function dupePhoneNumber($number){
                $conn = mysqli_connect('localhost','root','','gotogro-mrm');
                if(!$conn){
                    echo "Can't connect to database.";
                }
                $number = mysqli_real_escape_string($conn, $number);
                $sql_number = "SELECT * FROM member WHERE MemberPhone = '$number'";
                $result2 = mysqli_query($conn, $sql_number);
                if (mysqli_num_rows($result2) == 0){
                    return true;
                }else{
                  return false;
                }
            }
            if($valid_form){
                if (dupeEmail($_POST['email'])) {
                    if (dupePhoneNumber($_POST['number'])) {
                        $conn = mysqli_connect('localhost', 'root', '', 'gotogro-mrm');
                        if (!$conn) {
                            echo "Can't connect to database.";
                        }
                        $SQL = "INSERT INTO member (MemberFirstName, MemberLastName, MemberDateOfBirth, MemberEmail, 
                        MemberPhone, MemberAddress, MemberSuburb, MemberState, MemberPostcode, MemberJoinDate) 
                        VALUES ('$member_f', '$member_l', '$dob', '$email', '$number', '$street', '$suburb', '$state', '$postcode', NOW())";

                        $run = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                        if($run){?>
                            <script type="text/javascript">
                                alert("Your submission is successful.");
                                window.location.href = "member.php";
                            </script>
                                <?php
                        }
                    } else {
                        ?>
                            <script type="text/javascript">
                                alert("Duplicate phone number detected. Please try again.");
                            </script>
                        <?php
                    }
                } else {
                    ?>
                        <script type="text/javascript">
                            alert("Duplicate email detected. Please try again.");
                        </script>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>