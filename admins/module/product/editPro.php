<?php
$id = Utils::getIndex("id");
$r = $product->getDetail($id);
$ac2 = "saveEdit";
$info = "Sửa Sản phẩm!";
//get list category
$category = new Category();
$list_category = $category->getAll();
//get list supplier
$supplier = new Supplier();
$list_supplier = $supplier->getAll();

if (Count($r) == 0) //khong co -> them moi
{
    $ac2 = "saveAdd";
    $info = "Thêm Mới Sản phẩm";
    $r["Pro_Name"] = "";
    $r["Pro_Quantity"] = "";
    $r["Price"] = "";
    $r["Pro_Description"] = "";
    $r["Pro_Image"] = "";
    $r["Supplier_Id"] = "";
    $r["Category_Id"] = "";
    $r['Pro_Id'] = '';
}

if (isset($_SESSION['data']))
{

    $r["Pro_Name"] = $_SESSION['data']['name'];
    $r["Pro_Quantity"] = $_SESSION['data']['quantity'];
    $r["Price"] = $_SESSION['data']['price'];
    $r["Pro_Description"] = $_SESSION['data']['description'];

    unset($_SESSION['data']);
}
?>
<div class="container mb-4">
    <form action="index.php?mod=product&group=pro&ac=<?php echo $ac2; ?>" method="post" enctype="multipart/form-data">

        <input name="id" value="<?php echo $r['Pro_Id']; ?>" hidden />
        <div class="form-row row">
            <div class="form-group col-md-9 mb-3">
                <label for="inputTen">Tên sản phẩm</label>
                <input type="text" name="pro_name" class="form-control
                <?php
                if (isset($_SESSION['validate']['name']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputTen" placeholder="Tên sản phẩm" value="<?php echo $r["Pro_Name"]; ?>">
                <?php
                if (isset($_SESSION['validate']['name']))
                {
                    ?>
                    <div class="invalid-feedback"><?php echo $_SESSION['validate']['name'][0]; ?></div>
                    <?php
                }
                ?>
            </div>



            <div class="form-group col-md-3 mb-3">
                <label for="inputGia">Giá</label>
                <input type="number" name="pro_price" min="10000" class="form-control 
                <?php
                if (isset($_SESSION['validate']['price']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputGia" placeholder="Giá sản phẩm" value="<?php echo $r["Price"]; ?>">
                <?php
                if (isset($_SESSION['validate']['price']))
                {
                    echo "<div class=" . 'invalid-feedback' . ">" . $_SESSION['validate']['price'][0] . "</div>";
                }
                ?>

            </div>
        </div>


        <div class="form-row row">
            <div class="form-group col-md-3 mb-3">
                <label for="inputSL">Số lượng</label>
                <input type="number" name="pro_quantity" class="form-control
                <?php
                if (isset($_SESSION['validate']['quantity']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputSL" placeholder="Số lượng" value="<?php echo $r["Pro_Quantity"]; ?>">
                <?php
                if (isset($_SESSION['validate']['quantity']))
                {
                    echo "<div class=" . 'invalid-feedback' . ">" . $_SESSION['validate']['quantity'][0] . "</div>";
                }
                ?>
            </div>
            <div class="form-group col-md-9 mb-3">
                <label for="inputMota">Mô tả</label>
                <textarea name="pro_des" class="form-control
                <?php
                if (isset($_SESSION['validate']['description']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputMota" placeholder="Mô tả"><?php echo $r["Pro_Description"]; ?></textarea>
                <?php
                if (isset($_SESSION['validate']['description']))
                {
                    echo "<div class=" . 'invalid-feedback' . ">" . $_SESSION['validate']['description'][0] . "</div>";
                }
                ?>
            </div>
        </div>


        <div class="form-row row">
            <div class="form-group col-md-4 mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Danh mục</label>
                </div>
                <select class="custom-select w-100" name="cat_id" id="inputGroupSelect01">
                    <?php
                    foreach ($list_category as $value)
                    {
                        ?>
                        <option value="<?php echo $value["Category_Id"]; ?>"><?php echo $value["Category_Name"]; ?></option>

                        <?php

                    }

                    ?>
                </select>
            </div>
            <div class="form-group col-md-4 mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Danh mục</label>
                </div>
                <select class="custom-select w-100" name="sup_id" id="inputGroupSelect01">
                    <?php
                    foreach ($list_supplier as $value)
                    {
                        ?>
                        <option value="<?php echo $value["Supplier_Id"]; ?>"><?php echo $value["Supplier_Name"]; ?></option>

                        <?php

                    }

                    ?>
                </select>
            </div>

            <!-- image -->
            <div class="form-group col-md-4 mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload file image</span>
                </div>
                <div class="custom-file w-100">
                    <input type="file" name="pro_image" class="custom-file-input" id="inputGroupFile01">

                    <?php
                    if (isset($_SESSION['validate']['image']))
                    {
                        echo "<div class=" . 'invalid-feedback' . ">" . $_SESSION['validate']['image'][0] . "</div>";
                    }

                    if ($r["Pro_Image"] != '')
                    {
                        ?>

                        <img src="<?php echo BASE_URL . 'image/uploads/' . $r['Pro_Image']; ?>" class="img-fluid img-thumbnail"
                            style="width:50%" />
                        <?php
                    }

                    ?>

                </div>
            </div>
        </div>



        <div class="form-group row mt-2">
            <div class="col-sm-10">
                <input class="btn btn-secondary" type="Reset">
                <input class="btn btn-primary" type="submit" value="Thực Hiện">
            </div>
        </div>
    </form>
</div>
<?php

if (isset($_SESSION['validate']))
{
    unset($_SESSION['validate']);
}
?>