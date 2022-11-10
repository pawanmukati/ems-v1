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

// get employee 
if($_SESSION['ROLE']=="subadmin" || $_SESSION['ROLE']=="admin"){
   $res=mysqli_query($con,"select * from employee where user_role='employee' order by id asc ");
}

?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Employee</h4>
						         <h4 class="box_title_link"><a href="add_employee.php" class="btn btn-primary" >Add Employee</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table table-responsive w-auto">
                                 <thead>
                                    <tr>
                                       <!-- <th width="auto">S.No</th> -->
                                       <th width="10%">Emp. ID</th>
                                       <th width="10%">User type</th>
                                       <th width="15%">Name</th>
                                       <th width="20%">Email</th>
                                       <th width="20%">Mobile</th>
                                       <th width="15%">Address</th>
                                       <th width="15%">Active Status</th>
                                       <th width="auto"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									// $i=1;
									while($row=mysqli_fetch_assoc($res)){
                              $bdate = $row['birthday'];
                              $dojdate = $row['doj'];
                              $bUpdatedate= date('d-m-Y', strtotime($bdate));
                              $dojUpdatedate= date('d-m-Y', strtotime($dojdate));
                              ?>
                              <tr>
                                 <!-- <td><?php echo $i?></td> -->
                                 <td><?php echo $row['employee_id']?></td>
                                 <td><?php echo $row['user_role']?></td>
                                 <td><?php echo $row['username']?></td>
                                 <td><?php echo $row['email']?></td>
                                 <td><?php echo $row['mobile']?></td>
                                 <td><?php echo $row['address']?></td>
                                 <?php 
                                 if(!$row['active_emp'] == 1){?>
                                    <td><?php echo 'False' ?></td>
                                 <?php } else{?>
                                    <td><?php echo 'True' ?></td>
                                 <?php } ?>
                                 <td><a class="btn btn-primary" href="employee_all_details.php?id=<?php echo $row['id']?>">More Details</a></td>
                               
                              </tr>
									<?php 
									// $i++;
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