<?php
require('top.inc.php');

$message = '';

if (isset($_POST["upload"])) {
    if ($_FILES['file']['name']) {
        $filename = explode(".", $_FILES['file']['name']);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $empid = mysqli_real_escape_string($con, $data[0]);
                $months = mysqli_real_escape_string($con, $data[1]);
                $total_working_days = mysqli_real_escape_string($con, $data[2]);
                $present_days = mysqli_real_escape_string($con, $data[3]);
                $leaves = mysqli_real_escape_string($con, $data[4]);
                $total_hrs = mysqli_real_escape_string($con, $data[5]);
                $paid_leaves = mysqli_real_escape_string($con, $data[6]);
                $adjusments = mysqli_real_escape_string($con, $data[7]);
                // $query = "update employee set
                //             'months' = '$months',
                //             'total_working_days' = '$total_working_days',
                //             'present_days' = '$present_days',
                //             'leaves' = '$leaves',
                //             'total_hrs' = '$total_hrs',
                //             'paid_leaves' = '$paid_leaves',
                //             'adjusments' = '$adjusments' where empid='$empid'";

                $query = "insert into employee_payroll_data (empid,months,total_working_days,present_days,leaves,total_hrs,paid_leaves,adjusments) 
                VALUES ('$empid', '$months', '$total_working_days', '$present_days', '$leaves', '$total_hrs', '$paid_leaves', '$adjusments')";
            // echo $query;
                if (mysqli_query($con, $query)) {
                    echo "DATA INSERTED SUCCESSFULLY";
                } else {
                    die(mysqli_error($con));
                }
            }
            fclose($handle);
            header("location: employee_payroll_data.php?updation=1");
        } else {
            $message = '<label class="text-danger">Please Select CSV File only</label>';
        }
    } else {
        $message = '<label class="text-danger">Please Select File</label>';
    }
}

if (isset($_GET["updation"])) {
    $message = '<label class="text-success">Product Updation Done</label>';
}

$query = "SELECT * FROM employee_payroll_data";
$result = mysqli_query($con, $query);
?>
<!-- <!DOCTYPE html>
<html> -->
<!-- <head>
  <title>Update Mysql Database through Upload CSV File using PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head> -->
<!-- <body>
  <br /> -->
<link rel="stylesheet" href="style.css">
<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype='multipart/form-data'>
        <p>
            <label class="d-block">Please Select File(Only CSV Formate)</label>
            <input type="file" name="file" />
        </p>
        <br />
        <input type="submit" name="upload" class="btn btn-info" value="Upload" />
    </form>
</div>

<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Employee Monthly Data</h4>
						         <!-- <h4 class="box_title_link"><a href="add_employee.php" class="btn btn-primary" >Add Employee</a> </h4> -->
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table table-responsive w-auto">
                                 <thead>
                                    <tr>
                                       <th width="auto">S.No</th>
                                       <th width="12%">Employee ID</th>
                                       <th width="10%">Months</th>
                                       <th width="12%">Working Days</th>
                                       <th width="12%">Present Days</th>
                                       <th width="5%">Leaves</th>
                                       <th width="15%">Total Hours</th>
                                       <th width="auto">Paid Leaves</th>
                                       <th width="auto">Adjusments</th>
                                       <th width="auto"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
									$i=1;
									while($row=mysqli_fetch_assoc($result)){
                                        $_SESSION['EMP_ID']=$row['empid'];
                                        // echo $_SESSION['EMP_ID'];
                              ?>
                              <tr>
                                 
                                <td><?php echo $i?></td>
                                 <td><?php echo $row['empid']?></td>
                                 <td><?php echo $row['months']?></td>
                                 <td><?php echo $row['total_working_days']?></td>
                                 <td><?php echo $row['present_days']?></td>
                                 <td><?php echo $row['leaves']?></td>
                                 <td><?php echo $row['total_hrs']?></td>
                                 <td><?php echo $row['paid_leaves']?></td>
                                 <td><?php echo $row['adjusments']?></td>

                                 <td>
                                    <a href="employee_salary.php?id=<?php echo $row['empid']?>" class="btn btn-primary">Check Salary</i></a>
                                    <!-- <a href="employee.php?id=<?php echo $row['id']?>&type=delete" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a> -->
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