<?php

namespace zad2;

class Cart
{
    private $products = [];

    public function __construct(){
        $this->products = [];
    }

    public function addProduct(Product $product){
        $this->products[] = $product;
    }
    public function removeProduct(Product $product){
        if(in_array($product, $this->products) !== false) {
            unset($this->products[array_search($product, $this->products)]);
        }
    }
    public function getTotal(){
        $total = 0;
        foreach($this->products as $product){
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }
    public function __toString(){
        $string = "Products in cart: <br>";
        foreach($this->products as $product){
            $string .= $product."<br>";
        }
        $string .= "Total price: ". $this->getTotal();
        return $string;
    }
}