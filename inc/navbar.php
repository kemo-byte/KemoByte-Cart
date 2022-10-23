<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
        <h3 class="px-5">
            <i class="fas fa-shopping-basket"></i> KemoByte Cart
        </h3>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto">
        </div>
        <div class="navbar-item navbar-link active">
            <h5 class="px-5 cart">
                <a href="cart.php">

                    <i class="fas fa-shopping-cart"></i> Cart
                    <?php

                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);

                        echo "<span class='cart_count '>" . $count . "</span>";
                    } else {
                        echo "<span class='cart_count text-warning bg-dark'> 0</span>";
                    }

                    ?>
                </a>
            </h5>

        </div>
    </div>
</nav>