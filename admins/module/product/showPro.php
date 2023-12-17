<?php
$page = Utils::getIndex("page", 1);
$data = $product->getAll($page);
$page_count = $product->getPageCount();
$value = $product->getDetail(1);
?>
<?php include './inc/message.php' ?>
<!-- table -->
<table class="table table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mã sản phẩm</th>
            <th scope="col">Tên Sản phẩm</th>
            <th scope="col">Giá sản phẩm</th>
            <th style="width:8%">ảnh sản phẩm</th>
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
                <td><?php echo $r['Pro_Id'] ?></td>
                <td><?php echo $r['Pro_Name'] ?></td>
                <td><?php echo $r['Price'] ?></td>
                <td><img src="<?php echo BASE_URL. 'image/uploads/'.$r['Pro_Image']; ?>" class="img-fluid img-thumbnail"
                        style="width:100%" /></td>
                <td>
                    <a class="btn btn-outline-primary"
                        href="index.php?mod=product&group=pro&ac=edit&id=<?php echo $r["Pro_Id"]; ?>" title="Edit"><i
                            class="bi bi-pencil"></i></a>&nbsp;&nbsp;
                    <a class="btn btn-outline-primary" href="#exampleModal<?php echo $r["Pro_Id"]; ?>" data-bs-toggle="modal"
                        data-bs-target="#exampleModal<?php echo $r["Pro_Id"]; ?>">
                        <i class="bi bi-trash"></i>
                    </a>
                    <div class="modal fade" id="exampleModal<?php echo $r["Pro_Id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <<form action="index.php?mod=product&group=pro&ac=delete&id=<?php echo $r["Pro_Id"]; ?>"
                                    method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xóa danh mục <?php echo $r["Pro_Name"]; ?> </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Bạn có chắc xóa danh mục <?php echo $r["Pro_Name"]; ?></h4>
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
                          
                                <li class="page-item <?php echo $c; ?>">  <a href="index.php?mod=product&group=pro&page=<?php echo $i; ?>" class="page-link "
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