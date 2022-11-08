<?php
require('top.inc.php');

$eid=$_SESSION['USER_ID'];

$sql="SELECT * FROM `employee` WHERE `id`='" . $eid . "'";
$res=mysqli_query($con,$sql);
?>

<div class="main">
    <div class="card">
        <div class="card-body">
            <table>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        ;
                        ?>  
                      
                        <a href="add_employee.php?id=<?php echo $row['id']?>" class="float-right">
                            <i class="fa fa-pencil-square-o text-primary " aria-hidden="true"></i>
                        </a>
                    <tr>
                        <td>Employee-ID</td>
                        <td>:</td>
                        <td><?php echo $row['id']?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td><?php echo $row['username']?></td>
                        <!-- <td> <img src="<?php echo $row['pic']?>" alt="<?php echo $row['pic']?>" > </td> -->
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $row['email']?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>:</td>
                        <td><?php echo $row['mobile']?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $row['address']?></td>
                    </tr>
                    <tr>
                        <td>DOB</td>
                        <td>:</td>
                        <td><?php echo $row['birthday']?></td>
                    </tr>
                    <?php
                    }?>
                </tbody>
            </table>
        </div>
    </div>
    </body>

    </html>