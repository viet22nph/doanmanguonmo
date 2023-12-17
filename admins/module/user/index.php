<?php
$group = Utils::getIndex("group", "user");

if ($group == "user")
{

  $user = new User();

  $ac = Utils::getIndex("ac", "showUser");

  include ROOT . '/admins/module/user/editUser.php';

  if ($ac == 'showUser')
    include ROOT . "/admins/module/user/showUser.php";

  if ($ac == 'saveAdd')
  {
    $name = Utils::postIndex("name");
    $email = Utils::postIndex("email");
    $phone = Utils::postIndex('phone');
    $password = Utils::postIndex("password");
    $address = Utils::postIndex("address");

    $firstName = '';
    $lastName = '';

    $error = [];
    if ($name == "")
    {
      $error['name'][] = 'Dữ liệu chưa được nhập vào';
    }

    if ($email == "")
    {
      $error['email'][] = 'Dữ liệu chưa được nhập vào';
    }

    if (!Utils::isEmail($email))
    {
      $error['email'][] = 'Email không đúng định đạng';
    }
    if (!Utils::isPhone($phone))
    {
      $error['phone'][] = 'Số điện thoại không đúng định đạng';
    }
    if ($name != '')
    {
      $arrName = explode(' ', $name);

      if (count($arrName) > 1)
      {
        $lastName = $arrName[count($arrName) - 1];
        unset($arrName[count($arrName) - 1]);

      }
      $firstName = implode(" ", $arrName);
    }


    if ($error == [])
    {


      $pass = md5($password);
      $n = $user->insertData($firstName, $lastName, $email, $phone, $address, $pass);
      if ($n > 0)
      {
        $_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công người dùng'];

      } else
      {
        $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công người dùng'];
      }
      ?>
      <script language="javascript">
        window.location = "index.php?mod=user&group=user";

      </script>
      <?php
    } else
    {

      $_SESSION['data'] = ['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phone' => $phone];
      $_SESSION['validate'] = $error;
      ?>
      <script language="javascript">
        window.location = "index.php?mod=user&group=user";
      </script>
      <?php
    }

  }
  if ($ac == 'saveEdit')
  {
    $id = Utils::postIndex('id');
    $name = Utils::postIndex("name");
    $email = Utils::postIndex("email");
    $phone = Utils::postIndex('phone');
    $password = Utils::postIndex("password");
    $address = Utils::postIndex("address");

    $firstName = '';
    $lastName = '';

    $error = [];
    if ($name == "")
    {
      $error['name'][] = 'Dữ liệu chưa được nhập vào';
    }

    if ($email == "")
    {
      $error['email'][] = 'Dữ liệu chưa được nhập vào';
    }

    if (!Utils::isEmail($email))
    {
      $error['email'][] = 'Email không đúng định đạng';
    }
    if (!Utils::isPhone($phone))
    {
      $error['phone'][] = 'Số điện thoại không đúng định đạng';
    }
    if ($name != '')
    {
      $arrName = explode(' ', $name);

      if (count($arrName) > 1)
      {
        $lastName = $arrName[count($arrName) - 1];
        unset($arrName[count($arrName) - 1]);

      }
      $firstName = implode(" ", $arrName);
    }


    if ($error == [])
    {

      if ($password == '')
      {
        $n = $user->updateDataNotPassword($id, $firstName, $lastName, $email, $phone, $address);
        if ($n > 0)
        {
          $_SESSION['message'] = ['alertType' => 'success', 'message' => 'Sửa thành công người dùng'];

        } else
        {
          $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Sửa không thành công người dùng'];
        }
        ?>
        <script language="javascript">
          window.location = "index.php?mod=user&group=user";

        </script>
        <?php
      } else
      {
        $pass = md5($password);
        $n = $user->updateData($id, $firstName, $lastName, $email, $phone, $address, $pass);
        if ($n > 0)
        {
          $_SESSION['message'] = ['alertType' => 'success', 'message' => 'Thêm thành công người dùng'];

        } else
        {
          $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Thêm không thành công người dùng'];
        }
        ?>
        <script language="javascript">
          window.location = "index.php?mod=user&group=user";

        </script>
        <?php
      }

    } else
    {

      $_SESSION['data'] = ['firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phone' => $phone];
      $_SESSION['validate'] = $error;
      ?>
      <script language="javascript">
        window.location = "index.php?mod=user&group=user";
      </script>
      <?php
    }

  }
  if ($ac == 'delete')
  {
    $id = Utils::getIndex('id');
    $n = $user->delete($id);
    if ($n > 0)
    {
      $_SESSION['message'] = ['alertType' => 'success', 'message' => 'Xóa thành công người dùng'];

    } else
    {
      $_SESSION['message'] = ['alertType' => 'danger', 'message' => 'Xóa không thành công người dùng'];
    }
    ?>
    <script language="javascript">
      window.location = "index.php?mod=user&group=user";

    </script>
    <?php
  }
}