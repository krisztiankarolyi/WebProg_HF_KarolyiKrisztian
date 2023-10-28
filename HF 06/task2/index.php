<!DOCTYPE html>
<html>
<head>
    <title>Regisztrációs űrlap</title>
</head>
<body>
<h2>Regisztrációs űrlap</h2>
<form method="post" action="process.php">
    <label for="name">Név: <i style="color: red"><?php if(isset($errors) && !empty($errors["name"])) echo '*'?></i> </label>
    <input type="text" name="name" value="<?php if (isset($name)) echo $name?>"><br><br>

    <label for="email">E-mail cím: <i style="color: red"><?php if(isset($errors) && !empty($errors["email"])) echo '*'?></i></label>
    <input type="email" name="email" value="<?php if (isset($email)) echo $email?>"><br><br>

    <label for="password">Jelszó: <i style="color: red"><?php if(isset($errors) && !empty($errors["password"])) echo '*'?></i></label>
    <input type="password" name="password" value="<?php if (isset($password)) echo $password?>"><br><br>

    <label for="confirm_password">Jelszó megerősítése: <i style="color: red"><?php if(isset($errors) && !empty($errors["confirm_password"])) echo '* '?></i></label>
    <input type="password" name="confirm_password" value="<?php if (isset($confirm_password)) echo $confirm_password?>"><br><br>

    <label for="birthdate">Születési dátum:  <i style="color: red"><?php if(isset($errors) && !empty($errors["birthdate"])) echo '*'?></i></label>
    <input type="date" name="birthdate" value="<?php if (isset($birthdate)) echo $birthdate?>"><br><br>

    <label for="gender">Nem: <i style="color: red"><?php if(isset($errors) && !empty($errors["gender"])) echo '* '?></i></label>
    <input type="radio" name="gender" value="Férfi" <?php if (isset($gender) && $gender == "Férfi") echo "checked"; ?>>Férfi
    <input type="radio" name="gender" value="Nő" <?php if (isset($gender) && $gender == "Nő") echo "checked"; ?>>Nő
    <br> <br>

    <label for="interests">Érdeklődési területek:</label><br>
    <input class="c" type="checkbox" name="interests[]" value="Sport" <?php if (isset($interests) && in_array("Sport", $interests)) echo "checked"; ?>>Sport
    <input class="c" type="checkbox" name="interests[]" value="Művészet" <?php if (isset($interests) && in_array("Művészet", $interests)) echo "checked"; ?>>Művészet
    <input class="c" type="checkbox" name="interests[]" value="Történelem" <?php if (isset($interests) && in_array("Történelem", $interests)) echo "checked"; ?>>Történelem
    <input class="c" type="checkbox" name="interests[]" value="IT" <?php if (isset($interests) && in_array("IT", $interests)) echo "checked"; ?>>IT
    <input class="c" type="checkbox" name="interests[]" value="Tudomány" <?php if (isset($interests) && in_array("Tudomány", $interests)) echo "checked"; ?>>Tudomány<br><br>


    <label for="country">Ország:</label>
    <select name="country">
        <option value="Magyarország" >Magyarország</option>
        <option value="Románia">Románia</option>
        <option value="Szlovákia">Szlovákia</option>
        <option value="Ukrajna">Ukrajna</option>
        <option value="Szerbia">Szerbia</option>
        <option value="Ausztria">Ausztria</option>
        <option value="Horvátország">Horvátország</option>
        <option value="Szlovénia">Szlovénia</option>
    </select><br><br>

    <input type="submit" id="submit" value="Regisztráció">
</form>
</body>
</html>