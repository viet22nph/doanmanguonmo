<?php
$id = Utils::getIndex("id");
$r = $user->getUserById($id);
$ac2 = "saveEdit";
$info = "Sửa Người Dùng!";
if (Count($r) == 0) //khong co -> them moi
{
    $ac2 = "saveAdd";
    $info = "Thêm Mới Người Dùng";
    $r["UserId"] = "";
    $r["FirstName"] = "";
    $r["LastName"] = "";
    $r["Phone"] = "";
    $r["Email"] = "";
    $r["Status"] = "";
    $r["Address"] = "";
    $r["Password"] = "";
}

if (isset($_SESSION['data']))
{

    $r["FirstName"] = $_SESSION['data']['firstName'];
    $r["LastName"] =  $_SESSION['data']['lastName'];
    $r["Email"] = $_SESSION['data']['email'];
    $r["Phone"] = $_SESSION['data']['phone'];
    echo '<pre>';
    var_dump($_SESSION['data']);
    echo'</pre>';
    unset($_SESSION['data']);
}

?>
<div class="container mb-4">
    <form action="index.php?mod=user&group=user&ac=<?php echo $ac2; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $r["UserId"]; ?>"/>
        <div class="form-row row">
            <div class="form-group col-md-6 mb-3">
                <label for="inputName">Họ tên</label>
                <input type="text" name="name" placeholder="Họ tên" class="form-control
                <?php
                if (isset($_SESSION['validate']['name']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputFistName" value="<?php  if($r["FirstName"]!=''|| $r["LastName"]!='') echo $r["FirstName"] . " " . $r["LastName"];?>">
                <?php
                if (isset($_SESSION['validate']['name']))
                {
                    ?>
                    <div class="invalid-feedback"><?php echo $_SESSION['validate']['name'][0]; ?></div>
                    <?php
                }
                ?>
            </div>


            <div class="form-group col-md-6 mb-3">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" class="form-control
                <?php
                if (isset($_SESSION['validate']['email']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputEmail" placeholder="Email" value="<?php echo $r["Email"]; ?>">
                <?php
                if (isset($_SESSION['validate']['email']))
                {
                    echo "<div class=" . 'invalid-feedback' . ">" . $_SESSION['validate']['email'][0] . "</div>";
                }
                ?>
            </div>
        </div>


        <div class="form-row row">
            <div class="form-group col-md-6 mb-3">
                <label for="inputPhone">Số điện thoại</label>
                <input type="text" name="phone" class="form-control
                <?php
                if (isset($_SESSION['validate']['phone']))
                {
                    ?>
                        is-invalid
                        <?php
                }
                ?>
                " id="inputPhone" placeholder="Số điện thoại" value="<?php echo $r["Phone"]; ?>">
                <?php
                if (isset($_SESSION['validate']['phone']))
                {
                    echo "<div class=" . 'invalid-feedback' . ">" . $_SESSION['validate']['phone'][0] . "</div>";
                }
                ?>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="inputPassword">Password</label>
                <input type="text" name="password" class="form-control " id="inputPassword" placeholder="Mật khẩu" value="">
                <?php
                ?>
            </div>

        </div>
        <div class="form-row row">
            <div class="form-group col-md-6 mb-3">
                <label for="inputAddress">Address</label>
                <textarea name="address" class="form-control " id="inputMota" placeholder="Địa chỉ"><?php echo $r["Address"]; ?></textarea>
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