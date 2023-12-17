<?php
$group = Utils::getIndex("group", "product");

//cho xu ly table category
if ($group == "cat")
{
	$category = new Category();
	$ac = Utils::getIndex("ac", "showCat");
	if ($ac != "delete")
		include ROOT . "/admins/module/product/editCat.php"; //Insert form edit or add new
	if ($ac == 'showCat')
		include ROOT . "/admins/module/product/showCat.php";

	if ($ac == "delete")
	{
		//xu ly xoa	
		$n = $category->delete(Utils::getIndex("id"));
		
		if ($n > 0)
		{
			$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Xóa thành công danh mục'];

		} else
		{
			$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Xóa không thành công danh mục'];
		}
		?>
		<script language="javascript">

			window.location = "index.php?mod=product&group=cat";

		</script>
		<?php
	}
	if ($ac == "saveEdit")
	{
		$id = Utils::postIndex("cat_id");
		$name = Utils::postIndex("cat_name");

		$error = [];
		if ($id == '')
		{
			$error['id'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($name == '')
		{
			$error['name'][] = 'Dữ liệu chưa được nhập vào!';
		}
		
		if ($error == [])
		{

			$n = $category->saveEdit($id, $name);
			if ($n > 0)
			{
				$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Sửa thành công danh mục'];

			} else
			{
				$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Sửa không thành công danh mục'];
			}
			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=cat";

			</script>
			<?php
		}
		$_SESSION['data'] = ['id' => $id, 'name' => $name];
		$_SESSION['validate'] = $error;
		?>
		<script language="javascript">
			window.location = "index.php?mod=product&group=cat&ac=edit&id=<?php echo $id; ?>";

		</script>
		<?php

	}
	if ($ac == "saveAdd")
	{
		$id = Utils::postIndex("cat_id");
		$name = Utils::postIndex("cat_name");
	
		$error = [];
		
		if ($id == '')
		{
			$error['id'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($name == '')
		{
			$error['name'][] = 'Dữ liệu chưa được nhập vào!';
		}
	
		?>
		
		<script language="javascript">
			window.location = "index.php?mod=product&group=cat";
		</script>
		<?php
		
	
		if ($error == [])
		{
			$data = $category->getByName($name);
		
			if( $data['Category_Name'] == $name||$data['Category_Id'] == $id)
			{
	
				$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm thành công danh mục khong thanh cong'];
				?>
				<script language="javascript">
					window.location = "index.php?mod=product&group=cat";
				</script>
				<?php
			}else{
				$n = $category->saveAddNew($id, $name);
				if ($n > 0)
				{
					$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công danh mục'];
	
				} else
				{
					$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công danh mục'];
				}
	
				?>
				<script language="javascript">
					window.location = "index.php?mod=product&group=cat";
	
				</script>
				<?php
			}
		
		}else{
			$_SESSION['data'] = ['id' => $id, 'name' => $name];
			$_SESSION['validate'] = $error;
			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=cat";
			</script>
			<?php
		}
	


	}
}
if ($group == "pro")
{
	$product = new Product();
	$ac = Utils::getIndex("ac", "showPro");

	if ($ac != "delete")
		include ROOT . "/admins/module/product/editPro.php";

	if ($ac == "showPro")
		include ROOT . "/admins/module/product/showPro.php";
	if ($ac == "delete")
	{
		//xu ly xoa	
		$n = $supplier->delete(Utils::getIndex("id"));
		if ($n > 0)
		{
			$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Xóa thành công danh mục'];

		} else
		{
			$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Xóa không thành công danh mục'];
		}
		?>
		<script language="javascript">

			window.location = "index.php?mod=product&group=pro";

		</script>
		<?php
	}
	if($ac == 'saveAdd')
	{
		$name = Utils::postIndex('pro_name');
		$price = Utils::postIndex('pro_price');
		$quantity = Utils::postIndex('pro_quantity');
		$description = Utils::postIndex('pro_des');
		$cat_id = Utils::postIndex('cat_id');
		$sup_id = Utils::postIndex('sup_id');
		$pro_image = Utils::filesIndex('pro_image');
	
		$error =[];
		if ($name == '')
		{
			$error['name'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($price == '')
		{
			$error['price'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($quantity == '')
		{
			$error['quantity'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($description == '')
		{
			$error['description'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if($pro_image == null)
		{
			$error['image'][] = 'Bạn chưa chọn ảnh cho sản phẩm!.';
		}
		if(!Utils::uploads($pro_image))
		{
			$error['image'][] = 'Ảnh không upload thành công!';
		}

		if($error==[])
		{
			$nameImg = $pro_image['name'];
			$n = $product->insert($name,$price,$nameImg,$description,$quantity,$cat_id,$sup_id);
			if ($n > 0)
			{
				$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công danh mục'];

			} else
			{
				$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công danh mục'];
			}

			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=pro";
			</script>
			<?php
		}else{
			$_SESSION['data'] = [ 'name' => $name,'price'=>$price, 'quantity'=>$quantity,'description'=>$description];
			$_SESSION['validate'] = $error;
			?>
		<script language="javascript">

			window.location = "index.php?mod=product&group=pro";

		</script>
		<?php
		}
		
		
	}

	if($ac == 'saveEdit')
	{
		$name = Utils::postIndex('pro_name');
		$price = Utils::postIndex('pro_price');
		$quantity = Utils::postIndex('pro_quantity');
		$description = Utils::postIndex('pro_des');
		$cat_id = Utils::postIndex('cat_id');
		$sup_id = Utils::postIndex('sup_id');
		$pro_image = Utils::filesIndex('pro_image');
		$id= Utils::postIndex('id');

		$error =[];
		if ($name == '')
		{
			$error['name'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($price == '')
		{
			$error['price'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($quantity == '')
		{
			$error['quantity'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($description == '')
		{
			$error['description'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if( $pro_image['name']!='')
		{
			if(!Utils::uploads($pro_image))
			{
				$error['image'][] = 'Ảnh không upload thành công!';
			}
			
		}
		if($error==[])
		{
			$nameImg = $pro_image['name'];
			if($nameImg == '')
			{
				$n = $product->updateNotImage($id,$name,$price,$description,$quantity,$cat_id,$sup_id);
				if ($n > 0)
				{
					$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công danh mục'];
	
				} else
				{
					$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công danh mục'];
				}
			}else{
				$n = $product->update($id,$name,$price,$nameImg,$description,$quantity,$cat_id,$sup_id);
				if ($n > 0)
				{
					$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công danh mục'];
	
				} else
				{
					$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công danh mục'];
				}
			}
			

			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=pro";
			</script>
			<?php
		}else{
			$_SESSION['data'] = [ 'name' => $name,'price'=>$price, 'quantity'=>$quantity,'description'=>$description];
			$_SESSION['validate'] = $error;
			?>
		<script language="javascript">

			window.location = "index.php?mod=product&group=pro&ac=edit&id=<?php echo $id; ?>";

		</script>
		<?php
		}
		
	}
}

if ($group == "sup")
{
	$supplier = new Supplier();
	$ac = Utils::getIndex("ac", "showSup");

	if ($ac != "delete")
		include ROOT . "/admins/module/product/editSup.php";
	if ($ac == 'showSup')
		include ROOT . "/admins/module/product/showSup.php";
	if ($ac == "delete")
	{
		//xu ly xoa	
		$n = $supplier->delete(Utils::getIndex("id"));
		if ($n > 0)
		{
			$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Xóa thành công danh mục'];

		} else
		{
			$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Xóa không thành công danh mục'];
		}
		?>
		<script language="javascript">

			window.location = "index.php?mod=product&group=sup";

		</script>
		<?php
	}
	if ($ac == "saveEdit")
	{
		//xu ly edit -> and redirect to index.php -> mod-> action	

		$id = Utils::postIndex("sup_id");
		$name = Utils::postIndex("sup_name");
		$phone = Utils::postIndex("sup_phone");
		$email = Utils::postIndex("sup_email");
		$error = [];
		if ($id == '')
		{
			$error['id'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($name == '')
		{
			$error['name'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($phone == '')
		{
			$error['phone'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if (!Utils::isPhone($phone))
		{
			$error['phone'][] = 'Dữ liệu nhập vào không đúng định dạng!';
		}
		if ($email == '')
		{
			$error['email'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if (!Utils::isEmail($email))
		{
			$error['email'][] = 'Dữ liệu nhập vào không đúng định dạng!';
		}

		if ($error == [])
		{
			$n = $supplier->saveEdit($id, $name, $phone, $email);
			if ($n > 0)
			{
				$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Sửa thành công danh mục!'];

			} else
			{
				$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Sửa không thành công danh mục'];
			}
			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=sup";

			</script>
			<?php

		}
		$_SESSION['data'] = ['id' => $id, 'name' => $name, 'phone' => $phone, 'email' => $email];
		$_SESSION['validate'] = $error;
		?>
		<script language="javascript">
			window.location = "index.php?mod=product&group=sup&ac=edit&id=<?php echo $id; ?>";
		</script>
		<?php
	}
	if ($ac == "saveAdd")
	{
		//xu ly edit -> and redirect to index.php -> mod-> action	
		// get data về
		$id = Utils::postIndex("sup_id");
		$name = Utils::postIndex("sup_name");
		$phone = Utils::postIndex("sup_phone");
		$email = Utils::postIndex("sup_email");
		$error = [];
		if ($id == '')
		{
			$error['id'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($name == '')
		{
			$error['name'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if ($phone == '')
		{
			$error['phone'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if (!Utils::isPhone($phone))
		{
			$error['phone'][] = 'Dữ liệu nhập vào không đúng định dạng!';
		}
		if ($email == '')
		{
			$error['email'][] = 'Dữ liệu chưa được nhập vào!';
		}
		if (!Utils::isEmail($email))
		{
			$error['email'][] = 'Dữ liệu nhập vào không đúng định dạng!';
		}



		if ($error == [])
		{
			$n = $supplier->saveAddNew($id, $name, $phone, $email);
			if ($n > 0)
			{
				$_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công danh mục'];

			} else
			{
				$_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công danh mục'];
			}

			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=sup";
			</script>
			<?php
		} else
		{

			$_SESSION['validate'] = $error;
			$_SESSION['data'] = ['id' => $id, 'name' => $name, 'phone' => $phone, 'email' => $email, 'image'=>$pro_image];
			?>
			<script language="javascript">
				window.location = "index.php?mod=product&group=sup";
			</script>
			<?php
		}

	}
}