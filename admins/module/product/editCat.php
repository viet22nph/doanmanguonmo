<?php
$id = Utils::getIndex("id");
$r = $category->getById($id);
$ac2 = "saveEdit";
$info = "Sửa category!";
$count =Count($r);
if ($count == 0) //khong co -> them moi
{
    $ac2 = "saveAdd";
    $info = "Thêm Mới Category";
    $r["Category_Id"] = "";
    $r["Category_Name"] = "";
}
if (isset($_SESSION['data']))
{ 
    $r["Category_Id"] = $_SESSION['data']['id'];
    $r["Category_Name"] = $_SESSION['data']['name'];
    unset($_SESSION['data']);
}
?>
<div class="container mb-4">


    <form action="index.php?mod=product&group=cat&ac=<?php echo $ac2;?>" method="post">
        <fieldset>
            <legend><?php echo $info; ?></legend>

            <div class="form-group row">
                <label for="inputMaDanhMuc" class="col-sm-2 col-form-label">Mã danh mục</label>
                <div class="col-sm-10">
                    <input type="text" id="inputMaDanhMuc" class="form-control
                    <?php
                    if (isset($_SESSION['validate']['id']))
                    {
                        ?>
                        is-invalid
                        <?php
                    }
                    ?>
                    " name="cat_id" value="<?php echo $r["Category_Id"]; ?>">
                    <?php
                    if (isset($_SESSION['validate']['id']))
                    {
                        ?>
                        <div class="invalid-feedback"><?php echo $_SESSION['validate']['id'][0]; ?></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="form-group row mt-2">
                <label for="inputTenDanhMuc" class="col-sm-2 col-form-label">Tên danh mục</label>
                <div class="col-sm-10">
                    <input type="text" name="cat_name" class="form-control
                    <?php
                    if (isset($_SESSION['validate']['name']))
                    {
                        ?>
                        is-invalid
                        <?php
                    }
                    ?>
                    " id="inputPassword3" value="<?php echo $r["Category_Name"]; ?>">
               
                    <?php
                    if (isset($_SESSION['validate']['name']))
                    {
                        ?>
                        <div class="invalid-feedback"><?php echo $_SESSION['validate']['name'][0]; ?></div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="form-group row mt-2">
                <div class="col-sm-10">
                    <input class="btn btn-secondary" type="Reset">
                    <input class="btn btn-primary" type="submit" value="Thực Hiện">
                </div>
            </div>
        </fieldset>
    </form>
</div>

<?php 
    if(isset($_SESSION['validate']))
    {
        unset($_SESSION['validate']);
    }
?>