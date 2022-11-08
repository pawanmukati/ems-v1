<?php
require('top.inc.php');

// if($_SESSION['ROLE']!=2){
// 	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
// 	die();
// }

// delete leaves status
if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	mysqli_query($con,"delete from `leave` where id='$id'");
}
// update leaves status by admin
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	$status=mysqli_real_escape_string($con,$_GET['status']);
	mysqli_query($con,"update `leave` set leave_status='$status' where id='$id'");
}

// display leave in subadmin panel
if($_SESSION['ROLE']=="subadmin"){ 
	$eid=$_SESSION['USER_ID'];
   $sql="select `leave`.*, employee.username ,employee.id as eid from `leave`,employee where
    `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$res=mysqli_query($con,$sql);


?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Leave</h4>
                           <?php if($_SESSION['ROLE']=="subadmin"){ ?>
                           <h4 class="box_title_link"><a href="add_leave.php" class="btn btn-primary">Add Leave</a> </h4>
                           <?php } ?>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="10%">Name</th>
                                       <th width="15%">From</th>
                                       <th width="15%">To</th>
                                       <th width="20%">Description</th>
                                       <th width="15%">Status</th>
                                       <th width="10%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                
                                    $i=1;
                                    while($row=mysqli_fetch_assoc($res)){
                                       $fromDate = $row['leave_from'];
                                       $toDate = $row['leave_to'];
                                       $fromUpdatedate= date('d-m-Y', strtotime($fromDate));
                                       $toUpdatedate= date('d-m-Y', strtotime($toDate));
                                        ?>
                                    <tr>
                                                <td><?php echo $i?></td>
                                       <td><?php echo $row['id']?></td>
                                       <td><?php echo $row['username']?></td>
                                       <td><?php echo $fromUpdatedate?></td>
                                       <td><?php echo $toUpdatedate?></td>
                                       <td><?php echo $row['leave_description']?></td>
                                       <td>
                                          <?php
                                          if($row['leave_status']==1){
                                             echo "Applied";
                                          }if($row['leave_status']==2){
                                             echo "Approved";
                                          }if($row['leave_status']==3){
                                             echo "Rejected";
                                          }
                                          ?>
                                          <?php if($_SESSION['ROLE']=="admin"){ ?>
                                          <select class="form-control"
                                           onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
                                          <option value="">Update Status</option>
                                          <option value="2">Approved</option>
                                          <option value="3">Rejected</option>
                                          </select>
                                          <?php } ?>
                                          <script>
                                             function update_leave_status(id,select_value){
                                                window.location.href='subadminleave.php?id='+id+'&type=update&status='+select_value;
                                             }
                                          </script>
                                       </td>
                                       <td>
                                                <?php
                                       if($row['leave_status']==1){ ?>
                                       <a href="subadminleave.php?id=<?php echo $row['id']?>&type=delete"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                       <?php } ?>
                                                
                                                
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