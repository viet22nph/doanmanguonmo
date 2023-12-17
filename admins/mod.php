<?php
$mod = getIndex("mod","home");
			
if ($mod=="product")
	include "module/product/index.php";
if($mod =='order')
	include 'module/order/index.php';
if($mod =='user')
	include 'module/user/index.php';
?>
