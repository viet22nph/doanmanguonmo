<?php

$ac = Utils::getIndex('ac', 'home');
$product = new Product();
$order = new Order();
$detail = new DetailOrder();
$category = new Category();
$user = new User();
if ($ac == 'home')
{
    include ROOT . '/module/showProduct.php';
}

if ($ac == 'detail')
{   
    include ROOT . '/module/detail.php';
}