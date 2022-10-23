<?php

function component($product_name, $product_price, $product_img, $product_id)
{
    $component = '
    <div class="col-md-4 col-sm-12 my-3 my-md-0">
    <form action="index.php" method="post">
        <div class="card shadow">
            <div>
                <img class="img-fluid card-img-top" src="uploads/' . $product_img . '" alt="sandwitch">
            </div>
       
            <div class="card-body">

                <h5 class="card-title">' . $product_name . '</h5>
                <hr />
                <h6>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star "></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star "></i>
                    <i class="far fa-star"></i>
                </h6>
                <p class="card-text">This is a buger sandwitch</p>
                <h5>
                    <small><s class="text-secondary">$' . $product_price . '</s></small>
                    <span class="price">$' . $product_price - 50 . '</span>
                </h5>
                <button type="submit" name="add" class="btn btn-warning my-3">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                <input type="hidden" name="product_id" value=' . $product_id . '>
                </div>
        </div>
    </form>
</div>
    ';


    return $component;
}

function cartElement($product_name, $product_price, $product_img, $product_id)
{
    $element = '
    <form action="cart.php?action=remove&id=' . $product_id . '" method="post" class="cart-items">
    <div class="border rounded">
    <div class="row bg-white">
    <div class="col-md-3 pl-0">
    <img src="uploads/' . $product_img . '" alt ="image" class="img-fluid">
    </div>
    <div class="col-md-6">
    <h5 class="pt-2">' . $product_name . '</h5>
    <small class="text-secondary">Seller: dayilytuition</small>
    <h5 class="pt-2">$' . $product_price . '</h5>
    <button type="submit" class="btn btn-warning">Save</button>
    <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
    </div>
    <div class="col-md-3 py-5">
    <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-minus"></i></button>
    <input type="text" value="1" class="form-control w-25 d-inline">
    <button type="button" class="btn bg-light border rounded-circle"><i class="fas fa-plus"></i></button>
</div>
</div>
</div>
</form>
    ';
    return $element;
}
