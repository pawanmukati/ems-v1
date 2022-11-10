<?php
require('top.inc.php');
require_once('./tcpdf/tcpdf/tcpdf.php');




$uid = $_GET['id'];
// get employee 
if ($_SESSION['ROLE'] == "subadmin" || $_SESSION['ROLE'] == "admin") {
    // $emp_id = $_SESSION['EMP_ID'];
    $monthly_data = mysqli_query($con, "select * from employee_payroll_data where empid='$uid'");
    $full_salary = mysqli_query($con, "select * from employee where employee_id ='$uid'  ");
}
;

$full_salary_row = mysqli_fetch_assoc($full_salary);
$monthly_data_row = mysqli_fetch_assoc($monthly_data);

$base_salary = $full_salary_row['basic_salary'];
$HRA = $full_salary_row['hra'];
$PT = $full_salary_row['pt'];
$OA = $full_salary_row['oa'];
$gross_salary = ($base_salary + $HRA + $OA);
//calculate total unpaid days
$total_absent_days = $monthly_data_row['total_working_days'] - $monthly_data_row['present_days'];
$total_unpaid_days = $total_absent_days - $monthly_data_row['paid_leaves'];
$total_leave_deduction_amount = $total_unpaid_days * $gross_salary/25;
$deduction = $total_leave_deduction_amount + $PT;

$total_gross_salary = ($gross_salary / 25) * (25 - $total_unpaid_days);

$net_salary =  $total_gross_salary - $deduction;


?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <!-- <form method="post"> -->
            <a href="salary_invoice.php?id=<?php echo $uid ?>" class="float-right my-5 text-primary"
                onclick="fetch_data()">Genrate PDF</a>
            <!-- </form> -->
            <div class="text-center lh-1 mb-2 my-5">
                <h6 class="fw-bold">Payslip</h6> <span class="fw-normal">Payment slip for the month of
                    <?php echo $monthly_data_row['months'] ?>
                </span>
            </div>
            <div class="d-flex justify-content-end"> <span>Working Branch:Clever-monks</span> </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">
                                    <?php echo $monthly_data_row['empid'] ?>
                                </small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">
                                    <?php echo $full_salary_row['username'] ?>
                                </small> </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div> <span class="fw-bolder">NOD</span> <small class="ms-3">28</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">ESI No.</span> <small class="ms-3"></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">
                                    <?php echo $full_salary_row['bank_name'] ?>
                                </small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Designation</span> <small class="ms-3">Marketing Staff
                                    (MK)</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">
                                    <?php echo $full_salary_row['account_number'] ?>
                                </small> </div>
                        </div>
                    </div>
                </div>
                <table class="mt-4 table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Earnings</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Deductions</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Basic</th>
                            <td>
                                <?php echo $full_salary_row['basic_salary'] ?>
                            </td>
                            <td>PF</td>
                            <td>0.00</td>
                        </tr>
                       
                        <tr>
                            <th scope="row">HRA</th>
                            <td>
                                <?php echo $full_salary_row['hra'] ?>
                            </td>
                            <td>PT</td>
                            <td> <?php echo $full_salary_row['pt'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">OA</th>
                            <td>
                                <?php echo $full_salary_row['oa'] ?>
                            </td>
                            <td>Unpaid days</td>
                            <td><?php echo $total_absent_days ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Paid Leaves</th>
                            <td><?php echo $monthly_data_row['paid_leaves'] ?></td>
                        </tr>
                        <tr class="border-top">
                            <th scope="row">Total Earning</th>
                            <td>
                                <?php echo (int)$gross_salary; ?>
                            </td>
                            <td ><strong>Total Deductions</strong></td> 
                            <td><?php echo (int)$deduction ; ?></td> 
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-4"> <br> <span class="fw-bold">Net Pay :
                        <?php echo  (int)$net_salary; ?>
                    </span> </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For Clever Monks</span> <span
                        class="mt-4">Authorised Signatory</span> </div>
            </div>
        </div>
    </div>
</div>
<!-- --------- -->
