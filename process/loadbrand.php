<?php

require "../connection.php";

if (isset($_GET["c"])) {

    $cat_id = $_GET["c"];
    
    $cateory_res = Database::search("SELECT * FROM `brand_has_category` WHERE `category_cat_id`='" . $cat_id . "'");
    $cateory_num = $cateory_res->num_rows;
    ?>
        <option value="0"><?php echo ($cateory_num != 0 ? "Select Category" : "Try Searching for another category") ?></option>

    <?php
    for ($i = 0; $i < $cateory_num; $i++) {

        $cat_data = $cateory_res->fetch_assoc();
        $brand_res = Database::search("SELECT * FROM `brand` WHERE `brand_id`='" . $cat_data["brand_brand_id"] . "'");

        $brand_data = $brand_res->fetch_assoc();

?>

        <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

<?php
    }
}
