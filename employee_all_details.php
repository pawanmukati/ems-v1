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
                           <h4 class="box-title">Employee Details</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table table-responsive w-auto">
                                 <thead>
                                    <tr>
                                       <th width="auto">S.No</th>
                                       <th width="auto">ID</th>
                                       <th width="auto">User type</th>
                                       <th width="auto">Name</th>
                                       <th width="auto">Email</th>
                                       <th width="auto">Mobile</th>
                                       <th width="auto">Address</th>
                                       <th width="auto">DOB</th>
                                       <th width="auto">doj</th>
                                       <th width="auto">term_condition</th>
                                       <th width="auto">basic_salary</th>
                                       <th width="auto">hra</th>
                                       <th width="auto">pt</th>
                                       <th width="auto">oa</th>
                                       <th width="auto">bank_name</th>
                                       <th width="auto">holder_name</th>
                                       <th width="auto">account_number</th>
                                       <th width="auto">ifsc_code</th>
                                       <th width="auto"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($res)){
                              $bdate = $row['birthday'];
                              $dojdate = $row['doj'];
                              $bUpdatedate= date('d-m-Y', strtotime($bdate));
                              $dojUpdatedate= date('d-m-Y', strtotime($dojdate));
                              ?>
                              <tr>
                                 <td><?php echo $i?></td>
                                 <td><?php echo $row['employee_id']?></td>
                                 <td><?php echo $row['user_role']?></td>
                                 <td><?php echo $row['username']?></td>
                                 <td><?php echo $row['email']?></td>
                                 <td><?php echo $row['mobile']?></td>
                                 <td><?php echo $row['address']?></td>
                                 <!-- <td><a href="employee_all_details.php?id=<?php echo $row['id']?>">More Details</a></td> -->
                                 

                                 <td><?php echo $bUpdatedate ?></td>
                                 <td><?php echo $dojUpdatedate?></td>
                                 <td><?php echo $row['term_condition']?></td>
                                 <td><?php echo $row['basic_salary']?></td>
                                 <td><?php echo $row['hra']?></td>
                                 <td><?php echo $row['pt']?></td>
                                 <td><?php echo $row['oa']?></td>
                                 <td><?php echo $row['bank_name']?></td>
                                 <td><?php echo $row['holder_name']?></td>
                                 <td><?php echo $row['account_number']?></td>
                                 <td><?php echo $row['ifsc_code']?></td>

                                 <td>
                                    <a href="add_employee.php?id=<?php echo $row['id']?>"> <i class="fa fa-pencil-square-o text-primary " aria-hidden="true"></i></a>
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