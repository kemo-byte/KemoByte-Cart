<?php
session_start();

include('inc/components.php');
include('inc/DB.php');

$db = new DB();
// session_start();

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_id = array_column($_SESSION['cart'], "product_id");
        if (in_array($_POST['product_id'], $item_id)) {
            echo "<script>alert('product id already added to the cart')</script>";
            echo "<script>window.location = 'index.php';</script>";
        } else {
            $count = count($_SESSION['cart']);
            $item1 = array("product_id" => $_POST['product_id']);
            $_SESSION['cart'][$count] = $item1;
            // print_r($_SESSION['cart']);
        }
    } else {

        $item = array("product_id" => $_POST['product_id']);
        $_SESSION['cart'][] = $item;
    }


    print_r($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <title>Shopping Cart</title>
    <!-- <link rel="icon" href="img/dorra/logo.jpg" type="image/gif" sizes="16x16"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php
    include("inc/navbar.php");
    ?>
    <div class="container">
        <div class="row text-center py-5">
            <?php
            $rows = $db->getData();
            foreach ($rows as $row) {
                echo component($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
            }


            ?>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>

</body>

</html>