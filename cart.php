<?php
session_start();
include('inc/components.php');
include('inc/DB.php');

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['product_id'] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('The Product Removed From Cart'); </script>";
                echo "<script> window.location= 'cart.php'; </script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- <link rel="icon" href="img/dorra/logo.jpg" type="image/gif" sizes="16x16"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<?php
include('inc/navbar.php');
?>

<body>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <?php
                $total = 0;
                if (isset($_SESSION['cart'])) {
                    $product_id = array_column($_SESSION['cart'], 'product_id');
                    $db = new DB();


                    $result = $db->getData();
                    foreach ($result as $row) {
                        foreach ($product_id as $id) {
                            if ($row['id'] == $id) {
                                echo cartElement($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                                $total += (int)$row['product_price'];
                            }
                        }
                    }
                } else {
                    echo "Cart is Empty !";
                }
                ?>

            </div>
            <div class="col-md-5">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr />
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                                echo "<h6> Price ($count items)</h6>";
                            } else {
                                echo "<h6> Price (0 items)</h6>";
                            }

                            ?>
                            <h6>Delivery Charges</h6>
                            <hr />
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>$ <?php
                                    echo $total;
                                    ?></h6>
                            <h6 class="text-success">Free</h6>
                            <hr />
                            <h6>$ <?php
                                    echo $total;
                                    ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>

</body>

</html>