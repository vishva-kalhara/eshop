<?php

require '../connection.php';

if (isset($_GET["clr"])) {
    $newColor = $_GET["clr"];
    $existingColors_res = Database::search("SELECT * FROM `color` WHERE `clr_name`='" . $newColor . "'");
    $existingColors_num = $existingColors_res->num_rows;

    if ($existingColors_num == 0) {
        Database::iud("INSERT INTO `color` (`clr_name`) VALUES ('" . $newColor . "')");

        //  LOAD COLORS AGAIN
        $newColors_res = Database::search("SELECT * FROM `color` ORDER BY `clr_name` ASC");
        $newColors_num = $newColors_res->num_rows;

        for ($i = 0; $i < $newColors_num; $i++) {
            $newColors_data = $newColors_res->fetch_assoc();
?>
            <option value="<?php echo ($newColors_data["clr_id"]) ?>"><?php echo ($newColors_data["clr_name"]) ?></option>
<?php
        }
    }
}
