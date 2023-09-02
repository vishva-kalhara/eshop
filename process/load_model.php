<?php

require '../connection.php';

if (isset($_GET["b"])) {
    $sel_brand = $_GET["b"];

    $brand_res = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $sel_brand . "'");
    $brand_num = $brand_res->num_rows;
?>


    <option value="0"><?php echo ($brand_num != 0 ? "Select model" : "Try Searching for another brand") ?></option>


    <?php

    for ($i = 0; $i < $brand_num; $i++) {
        $brand_data = $brand_res->fetch_assoc();
        $model_id = $brand_data["model_model_id"];
        // echo($brand_data);
        $model_res = Database::search("SELECT * FROM `model` WHERE `model_id`='" . $model_id . "'");
        $model_data = $model_res->fetch_assoc();
        // <option value="<?php echo ($model_data["model_id"]) 
    ?>"><?php echo ($model_data["model_name"]) ?></option>

    ?>
    <option value="<?php echo ($model_data["model_id"]) ?>"><?php echo ($model_data["model_name"]) ?></option>
    <!-- <option value="0">gg</option> -->
<?php

    }
}
