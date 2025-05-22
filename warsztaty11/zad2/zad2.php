<?php

require_once "Product.php";
require_once "Cart.php";

use zad2\Product;
use zad2\Cart;

$cart = new Cart();
$cart->addProduct(new Product("Laptop", 1500, 1));
$cart->addProduct(new Product("TV", 3500, 2));
echo $cart;