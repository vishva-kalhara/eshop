<?php
require "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="./resources/img/logo.svg">
    <title>Input_data</title>
</head>

<body>
    <input type="text" placeholder="title" class="form-control" id="title">
    <select class="form-control" id="gender">
        <option value="0">Select your gender</option>
        <?php

        $rs = Database::search("SELECT * FROM eshop.gender");
        $n = $rs->num_rows;
        for ($i = 0; $i < $n; $i++) {
            $d = $rs->fetch_assoc();
        ?>
            <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
        <?php

        }
        ?>
    </select>
    <select class="form-control" id="gender" title="category">
        <option value="0">Select your gender</option>
        <?php

        $rs = Database::search("SELECT * FROM eshop.gender");
        $n = $rs->num_rows;
        for ($i = 0; $i < $n; $i++) {
            $d = $rs->fetch_assoc();
        ?>
            <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>
        <?php

        }
        ?>
    </select>
</body>

</html>