<?php
$products = [
 ['name' => 'Sản phẩm 1', 'price' => '1000'],
 ['name' => 'Sản phẩm 2', 'price' => '2000'],
 ['name' => 'Sản phẩm 3', 'price' => '3000'],
 ['name' => 'Sản phẩm 4', 'price' => '4000']
];
if(isset($_POST['name'])){
    $products[] = ['name'=> $_POST['name'],'price'=> $_POST['price']];
}