<?php
$id = Utils::getIndex("id");
$r = $supplier->getById($id);
$ac2 = "saveEdit";
$info = "Sửa Nhà Cung Cấp!";
if (Count($r) == 0) //khong co -> them moi
{
    $ac2 = "saveAdd";
    $info = "Thêm Mới Nhà Cung Cấp";
    $r["Supplier_Id"] = "";
    $r["Supplier_Name"] = "";
    $r["Email"] = "";
    $r["Phone"] = "";
}

if(isset($_SESSION['data']))
{
    
    $r["Supplier_Id"] = $_SESSION['data']['id'];
    $r["Supplier_Name"] = $_SESSION['data']['name'];
    $r["Email"] = $_SESSION['data']['email'];
    $r["Phone"] = $_SESSION['data']['phone'];
    
    unset($_SESSION['data']);
}

?>
<div class="container mb-4">
    <form action="index.php?mod=product&group=sup&ac=<?php echo $ac2; ?>" method="post">
        <div class="form-row row">
            <div class="form-group col-md-5 mb-3">
                <label for="inputMa">Mã nhà cung cấp</label>
                <input type="text" name="sup_id" class="form-control
                <?php
                    if(isset($_SESSION['validate']['id']))
                    {
                        ?>
                        is-invalid
                        <?php
                    }
                ?>
                " id="inputMa" placeholder="Mã nhà cung cấp" value="<?php echo $r["Supplier_Id"]; ?>">
                <?php
                    if(isset($_SESSION['validate']['id']))
                    {
                        ?>
                            <div class="invalid-feedback"><?php echo $_SESSION['validate']['id'][0]; ?></div>
                        <?php
                    }
                ?>
            </div>



            <div class="form-group col-md-7 mb-3">
                <label for="inputTen">Tên nhà cung cấp</label>
                <input type="text" name="sup_name" class="form-control
                <?php
                    if(isset($_SESSION['validate']['name']))
                    {
                        ?>
                        is-invalid
                        <?php
                    }
                ?>
                " id="inputTen" placeholder="Nhà cung cấp" value="<?php echo $r["Supplier_Name"]; ?>">
                <?php
                    if(isset($_SESSION['validate']['name']))
                    {
                        echo "<div class=".'invalid-feedback'.">".$_SESSION['validate']['name'][0]."</div>";
                    }
                ?>
            </div>
        </div>


        <div class="form-row row">
            <div class="form-group col-md-5 mb-3">
                <label for="inputPhone">Số điện thoại</label>
                <input type="text" name="sup_phone" class="form-control
                <?php
                    if(isset($_SESSION['validate']['phone']))
                    {
                        ?>
                        is-invalid
                        <?php
                    }
                ?>
                " id="inputPhone" placeholder="Số điện thoại" value="<?php echo $r["Phone"]; ?>">
                <?php
                    if(isset($_SESSION['validate']['phone']))
                    {
                        echo "<div class=".'invalid-feedback'.">".$_SESSION['validate']['phone'][0]."</div>";
                    }
                ?>
            </div>
            <div class="form-group col-md-7 mb-3">
                <label for="inputEmail">Email</label>
                <input type="email" name="sup_email" class="form-control
                <?php
                    if(isset($_SESSION['validate']['email']))
                    {
                        ?>
                        is-invalid
                        <?php
                    }
                ?>
                " id="inputEmail" placeholder="Email" value="<?php echo $r["Email"]; ?>">
                <?php
                    if(isset($_SESSION['validate']['email']))
                    {
                        echo "<div class=".'invalid-feedback'.">".$_SESSION['validate']['email'][0]."</div>";
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
    </form>
</div>
<?php 

if(isset($_SESSION['validate']))
{
    unset($_SESSION['validate']);
}
?>