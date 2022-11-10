<?php
function fetch_data()
{
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "employee_leave_managment");

    $uid = $_GET['id'];
    // get employee 
    // if($_SESSION['ROLE']=="subadmin" || $_SESSION['ROLE']=="admin"){
    // $emp_id = $_SESSION['EMP_ID'];
    $monthly_data = mysqli_query($connect, "select * from employee_payroll_data where empid='$uid'");
    $full_salary = mysqli_query($connect, "select * from employee where employee_id ='$uid'  ");
    // };

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

    return $output .= '
    <div class="text-center lh-1 mb-2 my-5">
    <h6 class="fw-bold">Payslip</h6> <span class="fw-normal">Payment slip for the month of ' .
        $monthly_data_row['months'] . '</span>
    </div>
    <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">' . $monthly_data_row['empid'] .
    '</small> </div>
    <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">' . $full_salary_row['username'] .
    '</small> </div>
    <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">' . $full_salary_row['bank_name'] .
    '</small> </div>
    <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">' . $full_salary_row['account_number'] .
                        '</small> </div>
                        
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
                <td>' . $full_salary_row['basic_salary'] . '</td>
                <td>PF</td>
                <td>0.00</td>
            </tr>
            <tr>
                <th scope="row">HRA</th>
                <td>' . $full_salary_row['hra'] . '</td>
                <td>PT</td>
                <td>' . $full_salary_row['pt'] . '</td>
            </tr>
            <tr>
                <th scope="row">OA</th>
                <td>' . $full_salary_row['oa'] . '</td>
                <td>Unpaid days</td>
                <td>' . $total_absent_days .'</td>
            </tr>
            <tr>
                <th scope="row">Paid Leaves</th>
                <td>' . $monthly_data_row['paid_leaves'] . '</td>
            </tr>
            <tr class="border-top">
                <th scope="row">Total Earning</th>
                <td>' . $total_gross_salary . '</td>
                <td>Total Deductions</td>
                <td>'.$deduction.'</td>
            </tr>
            
       
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-4"> <br> <span class="fw-bold">Net Pay : ' . $net_salary . '</span> </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For Clver Monks</span> <span
                class="mt-4">Authorised Signatory</span> </div>
    </div>

        ';







}
;

//  if(isset($_POST["create_pdf"]))  
//  {  
require_once('./tcpdf/tcpdf/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);
$obj_pdf->SetAutoPageBreak(TRUE, 10);
$obj_pdf->SetFont('helvetica', '', 12);
$obj_pdf->AddPage();
$content = '';
$content .= fetch_data();
//   $content .= '</table>';  
$obj_pdf->writeHTML($content);
$obj_pdf->Output('sample.pdf', 'I');
//  }  
?>