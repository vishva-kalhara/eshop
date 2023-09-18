<?php

session_start();
require "../connection.php";

$email = $_SESSION["u"]["email"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$query = "SELECT * FROM `product` WHERE `user_email`='$email' ";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

// Condition 1 --> Brand New
// Condition 2 --> Used
if ($condition != "0") {
    $query .= " AND `condition_id`='" . $condition . "'";
}

if ($time != "0" && $qty == "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `datetime_added` ASC";
    }
}

// qty 1 --> High to Low 
// qty 2 --> Low to High
if ($qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}

//  Time 1 = Newest to Oldest
//  Time 2 = Oldest to Newest
if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
}

 ?>
 <!-- <h3><?php echo $query ?></h3>
 <h3>time<?php echo $time ?></h3>
 <h3>qty<?php echo $qty ?></h3>
 <h3>condition<?php echo $condition ?></h3> -->

 <?php

// return;

?>



<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">

        <?php
        if (isset($_GET["page"])) {
            $page_num = $_GET["page"];
        } else {
            $page_num = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        ?>
        <!-- <h3><?php echo $query ?></h3> -->
        <?php

        $results_per_page = 5;
        $number_of_pages = ceil($product_num / $results_per_page);

        $page_results = ($page_num - 1) * $results_per_page;
        $selected_rs = Database::search("$query  LIMIT $results_per_page OFFSET $page_results");
        $selected_num = $selected_rs->num_rows;

        for ($i = 0; $i < $selected_num; $i++) {
            $selected_data = $selected_rs->fetch_assoc();
        ?>

            <!-- card -->
            <div class="card mb-3 mt-3 col-12 col-lg-6">
                <div class="row">
                    <div class="col-md-4 mt-4">

                        <?php
                        $pro_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "' LIMIT 1");
                        $pro_img_num = $pro_img_rs->num_rows;
                        $pro_img_data;
                        if ($pro_img_num == 1) {
                            $pro_img_data = $pro_img_rs->fetch_assoc();

                        }


                        ?>

                        <img src="<?php echo ($pro_img_data["img_path"]) ?>" class="img-fluid rounded-start" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo ($selected_data["title"]) ?></h5>
                            <span class="card-text fw-bold text-primary">LKR.<?php echo ($selected_data["price"]) ?></span><br />
                            <span class="card-text fw-bold text-success"><?php echo ($selected_data["qty"]) ?></span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_id"] == 2) { ?> checked <?php } ?> />
                                <label class="form-check-label fw-bold text-info" for="<?php echo $selected_data["id"]; ?>">
                                    <?php if ($selected_data["status_id"] == 2) { ?>
                                        Activate Product
                                    <?php } else {
                                    ?>
                                        Deactivate Product
                                    <?php
                                    } ?>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1">
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                        </div>
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-danger fw-bold">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>

        <!-- card -->

    </div>
</div>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" href="
                <?php
                if ($page_num <= 1) {
                    echo ("#");
                } else {
                    echo ("?page=" . ($page_num - 1));
                }
                ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($y = 1; $y <= $number_of_pages; $y++) {
                if ($y == $page_num) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" href="
                    <?php
                    if ($page_num >= $number_of_pages) {
                        echo ("#");
                    } else {
                        echo ("?page=" . ($page_num + 1));
                    }
                    ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>