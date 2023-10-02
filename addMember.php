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
        <h1 class = "center" >Add a new member record</h1>
        <div id="container">
            <form id="add_member" method="POST" action="member_process.php">
                <fieldset>
                    <legend>Please fill in all fields below.</legend>
                    <fieldset>
                        <p>
                            <label for="member_f">First name</label>
                            <input type="text" name="member_f" id="member_f" maxlength="20" size="10" required="required" />
                            <br><br>
                            <lable for="member_l">Last name</lable>
                            <input type="text" name="member_l" id="member_l" maxlength="=20" size="10" required="required" />
                        </p>
                    </fieldset>
                    <p>
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" maxlength="20" size="10" required="required" placeholder="dd/mm/yyyy" />
                    </p>
                    <p>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" size="30" required="required" />
                    </p>
                    <p>
                        <label for="number">Phone Number</label>
                        <input type="text" id="number" name="number" maxlength="12" minlength="8" required="required" />
                    </p>
                    <fieldset>
                        <p>
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" maxlength="100" required="required" />
                            <br><br>
                            <label for="suburb">Suburb</label>
                            <input type="text" id="suburb" name="suburb" maxlength="40" required="required" />
                            <br><br>
                            <label for="state">State</label>
                            <select name="state" id="state" required="required">
                                <option value=" ">Please Select</option>
                                <option value="VIC">VIC</option>
                                <option value="NSW">NSW</option>
                                <option value="QLD">QLD</option>
                                <option value="NT">NT</option>
                                <option value="WA">WA</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="ACT">ACT</option>
                            </select>
                        </p>
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode" maxlength="4" minlength="4" required="required" />
                    </fieldset>
                    <br>
                <input type="submit" value="Submit" />
                <input type="reset" value="Reset Form" />
                </fieldset>
            </form>
        </div>
    </body>
</html>