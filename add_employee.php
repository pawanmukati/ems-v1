<?php
ob_start();
session_start();
require('top.inc.php');
// if($_SESSION['ROLE']!="1"){
//     header('location:add_employee.php?id='.$_SESSION['USER_ID']);
//     die();
// }

$employee_id = '';
$username = '';
$email = '';
$mobile = '';
$address = '';
$birthday = '';
$user_role = '';
$password = '';
$id = '';
$doj = '';
$term_condition = '';
$basic_salary = '';
$hra = '';
$pt = '';
$oa = '';
$bank_name = '';
$holder_name = '';
$account_number = '';
$ifsc_code = '';
$profile = '';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    // if($_SESSION['ROLE']=="employee" && $_SESSION['USER_ID']!=$id){
    //     die("Access Denied");
    // }
    $res = mysqli_query($con, "select * from employee where id='$id'");
    $row = mysqli_fetch_assoc($res);
    $username = $row['username'];
    $email = $row['email'];
    $employee_id = $row['employee_id'];
    $password = $row['password'];
    $mobile = $row['mobile'];
    $address = $row['address'];
    $birthday = $row['birthday'];
    $user_role = $row['user_role'];

    $doj = $row['doj'];
    $term_condition = $row['term_condition'];
    $basic_salary = $row['basic_salary'];
    $hra = $row['hra'];
    $pt = $row['pt'];
    $oa = $row['oa'];
    $bank_name = $row['bank_name'];
    $holder_name = $row['holder_name'];
    $account_number = $row['account_number'];
    $ifsc_code = $row['ifsc_code'];
    $profile = $row['pic'];

    // $user_type = $row['user_type'];
}


if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $employee_id = mysqli_real_escape_string($con, $_POST['employee_id']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $user_role = mysqli_real_escape_string($con, $_POST['user_role']);
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);

    $doj = mysqli_real_escape_string($con, $_POST['doj']);
    $term_condition = mysqli_real_escape_string($con, $_POST['term_condition']);
    $basic_salary = mysqli_real_escape_string($con, $_POST['basic_salary']);
    $hra = mysqli_real_escape_string($con, $_POST['hra']);
    $pt = mysqli_real_escape_string($con, $_POST['pt']);
    $oa = mysqli_real_escape_string($con, $_POST['oa']);
    $bank_name = mysqli_real_escape_string($con, $_POST['bank_name']);
    $holder_name = mysqli_real_escape_string($con, $_POST['holder_name']);
    $account_number = mysqli_real_escape_string($con, $_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($con, $_POST['ifsc_code']);
    // $imageFile = ($_FILES['fileToUpload']);

    // $filename = $imageFile['name'];
    // $filepath = $imageFile['tmp_name'];
    // $fileerror = $imageFile['error'];

    // $destfile = 'uploads/'.$filename;
    // move_uploaded_file($filepath,$destfile);



    if ($_SESSION['ROLE'] == "employee") {
        if ($id > 0) {
            // update data in employee table by employee
            $sql = "update employee set username='$username',
                mobile='$mobile',address='$address',birthday='$birthday' where id='$id'";
        }
    }
    if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") {
        if ($id > 0) {
            // update data in and employee table by admin & subadmin
            $sql = "update employee set username='$username', email='$email',
                mobile='$mobile',address='$address',birthday='$birthday' 
                ,doj='$doj' ,term_condition='$term_condition' ,basic_salary='$basic_salary'
                ,hra='$hra' ,pt='$pt' ,oa='$oa' ,bank_name='$bank_name' ,holder_name='$holder_name'
                ,account_number='$account_number' ,ifsc_code='$ifsc_code',employee_id='$employee_id'
                where id='$id'";
        } else {
            // insert data in and employee table by admin & subadmin
            $sql = "insert into employee(username,email,password,mobile,address,birthday,role,user_role 
                ,doj ,term_condition ,basic_salary ,hra ,pt ,oa ,bank_name ,holder_name ,account_number ,ifsc_code ,employee_id) 
                values('$username','$email','$password','$mobile','$address','$birthday','2','$user_role'
                ,'$doj' ,'$term_condition' ,'$basic_salary' ,'$hra' ,'$pt' ,'$oa' ,'$bank_name' ,'$holder_name' ,'$account_number' ,'$ifsc_code','$employee_id'
               )";
        }
    }

    mysqli_multi_query($con, $sql);
    // echo $sql;
    if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") {
        header('location:employee.php');
    }
    if ($_SESSION['ROLE'] == "subadmin") {
        header('location:employee.php');
    } elseif ($_SESSION['ROLE'] == "employee") {
        header('location:employee-profile.php');
    }
    die();
}
// echo $id;
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") { ?>
                        <?php if ($id > 0) { ?>
                        <div class="card-header"><strong>Edit Employee</strong><small> Form</small></div>
                        <?php } else { ?>
                        <div class="card-header"><strong>Add Employee</strong><small> Form</small></div>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($_SESSION['ROLE'] == "employee") { ?>
                    <div class="card-header"><strong>Employee Details</strong><small> Form</small></div>
                    <?php } ?>

                    <div class="card-body card-block">
                        
                        
                        <?php  if($_SERVER['HTTP_REFERER'] == "employee-profile.php"){ ?>
                            <form method="post">
                                <div class="form-group">
                                    <label class=" form-control-label">Name</label>
                                    <input type="text" value="<?php echo $username ?>" name="username"
                                        placeholder="Enter employee name" class="form-control" required>
                                </div>
                                <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") { ?>
                                    <div class="form-group">
                                        <label class=" form-control-label">Email</label>
                                        <input type="text" value="<?php echo $email ?>" name="email"
                                            placeholder="Enter employee email" class="form-control" required>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class=" form-control-label">Phone Number</label>
                                    <input type="text" value="<?php echo $mobile ?>" name="mobile"
                                        placeholder="Enter employee phone number" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Address</label>
                                    <input type="text" value="<?php echo $address ?>" name="address"
                                        placeholder="Enter employee address" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">DOB</label>
                                    <input type="date" value="<?php echo $birthday ?>" name="birthday"
                                        placeholder="Enter employee DOB" class="form-control" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Submit</span>
                                </button>
                            </form>
                        <?php } ?>
                        <!-- edit employee form by admin and subadmin -->
                        <?php if ($id > 0) { ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                            <label class=" form-control-label">Employee ID</label>
                                            <input type="text" value="<?php echo $employee_id  ?>" name="employee_id"
                                                placeholder="Enter employee ID" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Name</label>
                                        <input type="text" value="<?php echo $username ?>" name="username"
                                            placeholder="Enter employee name" class="form-control" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class=" form-control-label">file</label>
                                         <input type="text" value="<?php echo $username ?>" name="username"
                                            placeholder="Enter employee name" class="form-control" required> 
                                         <input type="file" name="fileToUpload" id="fileToUpload"> 
                                    </div> -->
                                  
                                    <!-- <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") { ?> -->
                                        <div class="form-group">
                                            <label class=" form-control-label">Email</label>
                                            <input type="text" value="<?php echo $email ?>" name="email"
                                                placeholder="Enter employee email" class="form-control" required>
                                        </div>
                                    <!-- <?php } ?> -->
                                    <div class="form-group">
                                        <label class=" form-control-label">Phone Number</label>
                                        <input type="text" value="<?php echo $mobile ?>" name="mobile"
                                            placeholder="Enter employee phone number" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label class=" form-control-label">Address</label>
                                        <input type="text" value="<?php echo $address ?>" name="address"
                                            placeholder="Enter employee address" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">DOB</label>
                                        <input type="date" value="<?php echo $birthday ?>" name="birthday"
                                            placeholder="Enter employee DOB" class="form-control" required>
                                    </div>
                                    <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") { ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="my-3"><strong>Employee Job Information</strong></h4>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Date of Joining</label>
                                                    <input type="date" value="<?php echo $doj ?>" name="doj"
                                                        placeholder="Enter employee Joining date" class="form-control" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class=" form-control-label">Term and Conditions</label>
                                                    <input type="text" value="<?php echo $term_condition ?>" name="term_condition"
                                                        placeholder="Enter Term and Conditions" class="form-control" required>
                                                </div>

                                                <h4 class="my-3"><strong>Employee Salary deatils</strong></h4>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Basic Salary</label>
                                                    <input type="text" value="<?php echo $basic_salary ?>" name="basic_salary"
                                                        placeholder="Enter employee Basic salary" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" form-control-label">House Rent Allowance</label>
                                                    <input type="text" value="<?php echo $hra ?>" name="hra"
                                                        placeholder="Enter employee HRA" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Professional Tax</label>
                                                    <input type="text" value="<?php echo $pt ?>" name="pt"
                                                        placeholder="Enter employee PT" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Other Allowancess</label>
                                                    <input type="text" value="<?php echo $oa ?>" name="oa"
                                                        placeholder="Enter employee Other Allowancess" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="my-3"><strong>Employee Bank A/C deatils</strong></h4>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Bank Name</label>
                                                    <input type="text" value="<?php echo $bank_name ?>" name="bank_name"
                                                        placeholder="Enter employee Bank Name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Account Holder Name</label>
                                                    <input type="text" value="<?php echo $holder_name ?>" name="holder_name"
                                                        placeholder="Enter employee Account Holder Name" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Account Number</label>
                                                    <input type="text" value="<?php echo $account_number ?>" name="account_number"
                                                        placeholder="Enter employee Account Number" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" form-control-label">Bank IFSC Code</label>
                                                    <input type="text" value="<?php echo $ifsc_code ?>" name="ifsc_code"
                                                        placeholder="Enter employee Bank IFSC Code" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Submit</span>
                                    </button>
                               
                            </form>

                        <?php } else { ?>

                        <!-- add employee-form -->
                        <form method="post">
                            <h4 class="my-3"><strong>Employee information</strong></h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" form-control-label">Name</label>
                                        <input type="text" value="<?php echo $username ?>" name="username"
                                            placeholder="Enter employee name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Phone Number</label>
                                        <input type="number" value="<?php echo $mobile ?>" name="mobile"
                                            placeholder="Enter employee phone number" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Address</label>
                                        <input type="text" value="<?php echo $address ?>" name="address"
                                            placeholder="Enter employee address" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">DOB</label>
                                        <input type="date" value="<?php echo $birthday ?>" name="birthday"
                                            placeholder="Enter employee DOB" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label class=" form-control-label">Employee ID</label>
                                            <input type="text" value="<?php echo $employee_id  ?>" name="employee_id"
                                                placeholder="Enter employee ID" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Email</label>
                                        <input type="email" value="<?php echo $email ?>" name="email"
                                            placeholder="Enter employee email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Password</label>
                                        <input type="password" name="password" placeholder="Enter employee password"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4 class="my-3"><strong>Employee Job Information</strong></h4>

                                    <div class="form-group">
                                        <label class=" form-control-label">Date of Joining</label>
                                        <input type="date" value="<?php echo $doj ?>" name="doj"
                                            placeholder="Enter employee Joining date" class="form-control" required>
                                    </div>
                                    <?php if ($_SESSION['ROLE'] == "admin" || $_SESSION['ROLE'] == "subadmin") { ?>
                                    <label class=" form-control-label">Designation</label>
                                    <select class="form-control my-2" name="user_role">
                                        <option value="">Choose type</option>
                                        <option value="admin">admin</option>
                                        <option value="subadmin">subadmin</option>
                                        <option value="employee">employee</option>
                                    </select>
                                    <?php } ?>
                                    <script>
                                        function update_leave_status(id, select_value) {
                                            window.location.href = id + '&type=update&status=' + select_value;
                                        }
                                    </script>
                                    <div class="form-group">
                                        <label class=" form-control-label">Term and Conditions</label>
                                        <input type="text" value="<?php echo $term_condition ?>" name="term_condition"
                                            placeholder="Enter Term and Conditions" class="form-control" required>
                                    </div>

                                    <h4 class="my-3"><strong>Employee Salary deatils</strong></h4>
                                    <div class="form-group">
                                        <label class=" form-control-label">Basic Salary</label>
                                        <input type="text" value="<?php echo $basic_salary ?>" name="basic_salary"
                                            placeholder="Enter employee Basic salary" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">House Rent Allowance</label>
                                        <input type="text" value="<?php echo $hra ?>" name="hra"
                                            placeholder="Enter employee HRA" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Professional Tax</label>
                                        <input type="text" value="<?php echo $pt ?>" name="pt"
                                            placeholder="Enter employee PT" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Other Allowancess</label>
                                        <input type="text" value="<?php echo $oa ?>" name="oa"
                                            placeholder="Enter employee Other Allowancess" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="my-3"><strong>Employee Bank A/C deatils</strong></h4>
                                    <div class="form-group">
                                        <label class=" form-control-label">Bank Name</label>
                                        <input type="text" value="<?php echo $bank_name ?>" name="bank_name"
                                            placeholder="Enter employee Bank Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Account Holder Name</label>
                                        <input type="text" value="<?php echo $holder_name ?>" name="holder_name"
                                            placeholder="Enter employee Account Holder Name" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Account Number</label>
                                        <input type="" value="<?php echo $account_number ?>" name="account_number"
                                            placeholder="Enter employee Account Number" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Bank IFSC Code</label>
                                        <input type="text" value="<?php echo $ifsc_code ?>" name="ifsc_code"
                                            placeholder="Enter employee Bank IFSC Code" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>

                        </form>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// require('footer.inc.php');

?>