<?php
require('top.inc.php');

// if($_SESSION['ROLE']!="admin"){
// 	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
// 	die();
// }
// delete employee by ID 
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from employee where id='$id'");
}

// if($_SESSION['ROLE']=="admin"){
//    $res=mysqli_query($con,"select * from employee where user_role='employee' order by id asc  ");
// }
if($_SESSION['ROLE']=="admin"){
   $res=mysqli_query($con,"select * from employee where user_role='subadmin' order by id asc ");
}
// else{
//    $res=mysqli_query($con,"select * from employee order by id asc");
// }
?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Subadmin</h4>
						         <h4 class="box_title_link"><a href="add_employee.php" class="btn btn-primary" >Add SubAdmin</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="5%">User type</th>
                                       <th width="15%">Name</th>
                                       <th width="15%">Email</th>
                                       <th width="15%">Mobile</th>
                                       <th width="15%">Address</th>
                                       <th width="15%">DOB</th>
                                       <th width="15%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){

                              $bdate = $row['birthday'];
                              $bUpdatedate= date('d-m-Y', strtotime($bdate));
                              ?>
                              <tr>
                                 <td><?php echo $i?></td>
                                 <td><?php echo $row['id']?></td>
                                 <td><?php echo $row['user_role']?></td>
                                 <td><?php echo $row['username']?></td>
                                 <td><?php echo $row['email']?></td>
                                 <td><?php echo $row['mobile']?></td>
                                 <td><?php echo $row['address']?></td>
                                 <td><?php echo $bUpdatedate ?></td>
                                 <td>
                                    <a href="add_employee.php?id=<?php echo $row['id']?>"><i class="fa fa-pencil-square-o text-primary " aria-hidden="true"></i></a>
                                    <!-- <a href="?type=delete&id=<? echo $row['id'] ?>" onclick="return confirm('Are you sure you want to delete?')"><strong>Delete this Case</strong></a></td> -->
                                    <a href="employee.php?id=<?php echo $row['id']?>&type=delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                 </td>
                              </tr>
									<?php 
									$i++;
									} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         
<?php
// require('footer.inc.php');
?>