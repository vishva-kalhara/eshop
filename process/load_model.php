<?php

require '../connection.php';

if (isset($_GET["b"])) {
    $sel_brand = $_GET["b"];
    $sel_category = $_GET["c"];

    // $brand_res = Database::search("SELECT * FROM `eshop`.`brand_has_category` INNER JOIN `eshop`.`brand` ON `brand_has_category`.`brand_brand_id` = `brand`.`brand_id` INNER JOIN `eshop`.`category` ON `brand_has_category`.`category_cat_id` = `category`.`cat_id` WHERE `cat_id`='$sel_category' AND `brand_id`='$sel_brand'");
    $brand_res = Database::search("SELECT * FROM `model_has_brand` WHERE  `brand_brand_id`='" . $sel_brand . "'");
    $brand_num = $brand_res->num_rows;
    // $brand_num = 0;
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
