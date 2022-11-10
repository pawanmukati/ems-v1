<?php
require('top.inc.php');

// delete category by ID 
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['categoryid'])) {
	$id = mysqli_real_escape_string($con, $_GET['categoryid']);
	mysqli_query($con, "delete from ims_category where categoryid='$id'");

}


if (isset($_POST['add_cat'])) {
	$category = mysqli_real_escape_string($con, $_POST['category']);
	$sql = "insert into `ims_category`(name)values('$category')";
	mysqli_query($con, $sql);

	header('location:IT_categories.php');
	die();
}



$res = mysqli_query($con, "select * from ims_category");
?>

<!-- <div class="container">		 -->
<div class="row">
	<div class="col-lg-11 mx-auto">
		<div class="card card-default rounded-0 shadow">
			<div class="card-header">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
						<h3 class="card-title">IT Assets Category List</h3>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-end d-flex align-items-center">


						<!-- update-categories-modal -->
						<div class="modal fade" id="Update_cat" tabindex="-1" role="dialog"
							aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Update Category</h4>
										<button type="button" class="close" data-dismiss="modal"><span
												aria-hidden="true">&times;</span><span
												class="sr-only">Close</span></button>
									</div>
									<div class="modal-body">
										<form method="post" id="categoryForm">
											<label>Category Name</label>
											<input type="text" name="category" id="category"
												class="form-control rounded-0" required />
											<div class="modal-footer">
												<button type="sumit" class="btn btn-primary"
													name="update_cat">Update</button>
												<button type="button" class="btn btn-default"
													data-dismiss="modal">Close</button>
											</div>
										</form>
									</div>

								</div>
							</div>
						</div>



						<!-- add-categories Button trigger modal -->
						<button class="btn btn-primary ml-auto d-block" data-toggle="modal" data-target="#myModal">
							Add Category
						</button>

						<!-- add-categories-modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
							aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"><i class="fa fa-plus"></i> Add Category</h4>
										<button type="button" class="close" data-dismiss="modal"><span
												aria-hidden="true">&times;</span><span
												class="sr-only">Close</span></button>
									</div>
									<div class="modal-body">
										<form method="post" id="categoryForm">
											<label>Category Name</label>
											<input type="text" name="category" id="category"
												class="form-control rounded-0" required />
											<div class="modal-footer">
												<button type="sumit" class="btn btn-primary" name="add_cat">Add</button>
												<button type="button" class="btn btn-default"
													data-dismiss="modal">Close</button>
											</div>
										</form>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table id="categoryList" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Category Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                while ($row = mysqli_fetch_assoc($res)) {

                                ?>
								<tr>
									<td>
										<?php echo $row['categoryid'] ?>
									</td>
									<td>
										<?php echo $row['name'] ?>
									</td>
									<td>
										<?php echo $row['status'] ?>
									</td>
									<td>
										<a data-toggle="modal" data-target="#Update_cat" data-id="'.$row['ID'].'"
											href="categoryid=<?php echo $row['categoryid'] ?>"> <i
												class="fa fa-pencil-square-o text-primary " aria-hidden="true"></i></a>
										<a href="IT_categories.php?categoryid=<?php echo $row['categoryid'] ?>&type=delete"
											onclick="return confirm('Are you sure you want to delete?')"><i
												class="fa fa-trash text-danger" aria-hidden="true"></i></a>
									</td>
								</tr>
								<?php
                                } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


