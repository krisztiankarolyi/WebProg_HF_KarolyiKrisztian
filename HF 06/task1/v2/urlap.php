<!DOCTYPE html>
<html>
<head>
    <title>6. Házifeladat második verzió</title>
</head>
<body>
<h3>Online conference registration</h3>

<form method="post" action="process.php" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php if (isset($firstName)) echo $firstName; ?>">
        <span style="color: red;"><?php if (isset($firstNameErr)) echo $firstNameErr; ?></span> <!-- A hibaüzeneteket megjelenítem a megfelelő helyen -->
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php if (isset ($lastName)) echo $lastName; ?>">
        <span style="color: red;"><?php if (isset ($lastNameErr)) echo $lastNameErr; ?></span>
    </label>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email" value="<?php if (isset($email)) echo $email; ?>">
        <span style="color: red;"><?php if(isset($emailErr)) echo $emailErr; ?></span>
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <!-- ha az egyes jelölőnégyzetek értékei benne vannak a tömbben, tehát a beküldés előtt be voltak jelölve, akkor php-val ráolvasom a tag-re a checked tulajdonságot, így visszaállítva a korábbi munkamenetbeli állapotot -->
        <input type="checkbox" name="attend[]" value="Event1"
            <?php if (isset($_POST["attend"]) && in_array("Event1", $_POST["attend"])) echo "checked"; ?>>Event 1<br>
        <input type="checkbox" name="attend[]" value="Event2" <?php if (isset($_POST["attend"]) && in_array("Event2", $_POST["attend"])) echo "checked"; ?>>Event2<br>
        <input type="checkbox" name="attend[]" value="Event3" <?php if (isset($_POST["attend"]) && in_array("Event3", $_POST["attend"])) echo "checked"; ?>>Event3<br>
        <input type="checkbox" name="attend[]" value="Event4" <?php if (isset($_POST["attend"]) && in_array("Event4", $_POST["attend"])) echo "checked"; ?>>Event4<br>
        <span style="color: red;"><?php if (isset ($attendErr)) echo $attendErr; ?></span>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt"
        <option value="P" <?php if (isset($tshirt) && $tshirt == "Please select") echo "selected"; ?>>Please select</option>
        <option value="S" <?php if (isset($tshirt) && $tshirt == "S") echo "selected"; ?>>S</option>
        <option value="M" <?php if (isset($tshirt) && $tshirt == "M") echo "selected"; ?>>M</option>
        <option value="L" <?php if (isset($tshirt) && $tshirt == "L") echo "selected"; ?>>L</option>
        <option value="XL"<?php if (isset($tshirt) && $tshirt == "XL") echo "selected"; ?>>XL</option>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract">
        <span style="color: red;"><?php if(isset($abstractErr)) echo $abstractErr; ?></span>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="" <?php if (isset($_POST['terms'])) echo "checked"; ?>>I agree to terms & conditions.
    <span style="color: red;"><?php if(isset($termsErr)) echo $termsErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration">
</form>


</body>
</html>

</body>
</html>