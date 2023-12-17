<?php
$data = $category->getAll();
?>
<?php include './inc/message.php' ?>
<table class="table table-sm table-striped">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Loại danh mục</th>
            <th scope="col">Tên loại</th>
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
                <td><?php echo $r['Category_Id'] ?></td>
                <td><?php echo $r['Category_Name'] ?></td>
                <td>
                    <a class="btn btn-outline-primary" href="index.php?mod=product&group=cat&ac=edit&id=<?php echo $r["Category_Id"]; ?>" title="Edit"><i
                            class="bi bi-pencil"></i></a>&nbsp;&nbsp;
                    <a class="btn btn-outline-primary" href="#exampleModal<?php echo $r["Category_Id"]; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $r["Category_Id"]; ?>">
                        <i class="bi bi-trash"></i>
                    </a>
                    <div class="modal fade" id="exampleModal<?php echo $r["Category_Id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <<form action="index.php?mod=product&group=cat&ac=delete&id=<?php echo $r["Category_Id"]; ?>"
                                    method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xóa danh mục <?php echo $r["Category_Name"]; ?> </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Bạn có chắc xóa danh mục <?php echo $r["Category_Name"]; ?></h4>
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
</table>