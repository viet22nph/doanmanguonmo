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

if ($ac == 'login')
{
    include ROOT . '/module/login.php';
}
if ($ac == 'register')
{
    include ROOT . '/module/register.php';
}
if ($ac == 'handleRegister')
{
    $firstName = Utils::postIndex('firstName');
    $lastName = Utils::postIndex('lastName');
    $email = Utils::postIndex('email');
    $password = Utils::postIndex('password');
    $passwordCf = Utils::postIndex('password_Cf');
    $error = false;

    if ($firstName == '')
    {
        $error = true;
    }
    if ($lastName == '')
    {
        $error = true;
    }
    if ($email == '')
    {
        $error = true;
    }
    if (!Utils::isEmail($email))
    {
        $error = true;
    }
    if ($user->checkEmail($email))
    {
        $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Email đã tồn tại trong hệ thống!'];
        ?>
        <script language="javascript">

            window.location = "index.php?ac=register";

        </script>
        <?php
    }
    if ($passwordCf != $password)
    {
        return true;
    }

    if ($error)
    {

        $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Đăng ký không thành công'];
        ?>
        <script language="javascript">

            window.location = "index.php?ac=register";

        </script>
        <?php
    } else
    {

        $n = $user->insertData($firstName, $lastName, $email, '', '', md5($password));

        if ($n > 0)
        {
            $data = $user->userLogin($email, md5($password));

            if ($data != [])
            {
                $_SESSION["user_login"] = 1;
                $_SESSION["user_data"] = $data;
                ?>
                <script language="javascript">

                    window.location = "index.php?ac=home";

                </script>
                <?php
                exit;
            } else
            {
                $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Đăng ký không thành công'];
                ?>
                <script language="javascript">

                    window.location = "index.php?ac=register";

                </script>
                <?php
            }
        } else
        {
            $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Đăng ký không thành công'];
            ?>
            <script language="javascript">

                window.location = "index.php?ac=register";

            </script>
            <?php
        }
    }

}
if ($ac == 'handleLogin')
{
    $email = Utils::postIndex('email');
    $password = Utils::postIndex('password');
    $error = false;
    if ($email == '')
    {
        $error = true;
    }
    if (!Utils::isEmail($email))
    {
        $error = true;
    }

    if ($error)
    {

        $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Đăng nhập không thành công'];
        ?>
        <script language="javascript">

            window.location = "index.php?ac=login";

        </script>
        <?php
    } else
    {

        $data = $user->userLogin($email, md5($password));

        if ($data != [])
        {
            $_SESSION["user_login"] = 1;
            $_SESSION["user_data"] = $data;
            ?>
            <script language="javascript">

                window.location = "index.php?ac=home";

            </script>
            <?php
        } else
        {
            $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Đăng nhập không thành công'];
            ?>
            <script language="javascript">

                window.location = "index.php?ac=login";

            </script>
            <?php
        }
    }
}
if ($ac == 'logout')
{

    unset($_SESSION["user_login"]);
    unset($_SESSION["user_data"]);
    ?>
    <script language="javascript">

        //window.location = "index.php";

    </script>
    <?php

}