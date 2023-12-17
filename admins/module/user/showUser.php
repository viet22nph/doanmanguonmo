<?php
$page = Utils::getIndex("page", 1);
$data = $user->getAllUser($page);
$page_count = $user->getPageCount();

include ROOT . '/admins/inc/message.php';
?>

<table class="table table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mã khách hàng</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Email</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        foreach ($data as $r)
        { ?>
            <tr>
                <th scope="row"><?php echo $count; ?></th>
                <td><?php echo $r['UserId']; ?></td>
                <td><?php echo $r['FirstName'] . ' ' . $r['LastName'] ?></td>
                <td><?php echo $r['Email'] ?></td>
                <td><?php echo $r['Address'] ?? 'Chưa có địa chỉ' ?></td>
                <td><?php echo $r['Phone'] ?? 'Chưa có số điện thoại' ?></td>
                <td>
                    <a class="btn btn-outline-primary"
                        href="index.php?mod=user&group=user&ac=showDetail&id=<?php echo $r["UserId"]; ?>"
                        title="Chỉnh sửa">
                        <i class="bi bi-pencil"></i></a>&nbsp;&nbsp;
                    <a class="btn btn-outline-primary" href="#exampleModal<?php echo $r["UserId"]; ?>" data-bs-toggle="modal"
                        data-bs-target="#exampleModal<?php echo $r["UserId"]; ?>">
                        <i class="bi bi-trash"></i>
                    </a>
                    <div class="modal fade" id="exampleModal<?php echo $r["UserId"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form
                                    action="index.php?mod=user&group=user&ac=delete&id=<?php echo $r["UserId"]; ?>"
                                    method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xóa danh mục <?php echo $r['FirstName'] . ' ' . $r['LastName']; ?> </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Bạn có chắc xóa người dùng <?php echo $r['FirstName'] . ' ' . $r['LastName']; ?></h4>
                                        <p class="text-danger">Thao tác này sẽ không được hoàn tác nếu đã thực hiện!. </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Thực hiện xóa</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            <?php
            $count = $count + 1;
        }
        ?>

    </tbody>
    <!-- #region -->
    <tfoot>
        <tr>
            <td scope="col" colspan="6" class="" class="d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <?php
                        for ($i = 1; $i <= $page_count; $i++)
                        {
                            $c = " number ";
                            if ($i == $page)
                                $c .= " active "; ?>

                            <li class="page-item <?php echo $c; ?>"> <a
                                    href="index.php?mod=user&group=user&page=<?php echo $i; ?>" class="page-link "
                                    title="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>

                </nav>
            </td>
        </tr>
    </tfoot>
</table>