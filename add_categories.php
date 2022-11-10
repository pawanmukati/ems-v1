<?php
require('top.inc.php');

$id = $_GET['categoryid'];
$catName = '';
if (isset($_GET['categoryid'])) {
    $id = mysqli_real_escape_string($con, $_GET['categoryid']);

    $res = mysqli_query($con, "select * from ims_category where categoryid='$id'");
    $row = mysqli_fetch_assoc($res);
    $catName = $row['name'];
}
// if ($id > 0) {
// 	// update data in category table by admin
// 	$sql = "update ims_category set name='$catName' where categoryid='$id'";
// }

if (isset($_POST['update_cat'])) {
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $sql = "update ims_category set name='$catName' where categoryid='$id'";
    mysqli_query($con, $sql);

    header('location:IT_categories.php');
    die();
}


?>


<!-- update-categories-modal -->
<div class="modal fade" id="Update_cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus"></i> Update Category</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="categoryForm">
                    <label>Category Name</label>
                    <input type="text" name="category" id="category" class="form-control rounded-0" required />
                    <div class="modal-footer">
                        <button type="sumit" class="btn btn-primary" name="update_cat">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>