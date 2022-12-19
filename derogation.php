<?php
if (!isset($_POST['roll'])) {
    echo "<script>window.location='student.php'</script>";
}
$roll = $_POST['roll'];
require("js/view.php");
$MainView = new MainView();
if (isset($_FILES['file']['type'])) {
    if ($_FILES['file']['type']!="application/pdf") {
        echo "<script>alert('Only PDF file allowed ...')</script>";
    }else{
        class MainOperations extends DBConnection
        {
            
            function register_derogation($student_name,$student_id,$post,$files){
                $con = parent::connect();
                $filename  = basename($files['file']['name']);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $new_name       = str_replace(" ", "_", $student_name)."".substr(uniqid(), 7,4).'.'.$extension;

                if (move_uploaded_file($files['file']['tmp_name'], "img/derogation_requests/{$new_name}")) 
                {
                   
                   switch ($post['install_amount_two']) {
                       case '':
                              $amount2 = null;
                              $date2 = null;
                           break;
                       case null:
                              $amount2 = null;
                              $date2 = null;
                           break;
                       
                       default:
                              $amount2 = $post['install_amount_two'];
                              $date2 = $post['install_date_two'];
                           break;
                   }
                   switch ($post['install_date_two']) {
                       case '':
                              $amount2 = null;
                              $date2 = null;
                           break;
                       case null:
                              $amount2 = null;
                              $date2 = null;
                           break;
                       
                       default:
                              $amount2 = $post['install_amount_two'];
                              $date2 = $post['install_date_two'];
                           break;
                   }

                   $st_id = $student_id;
                   $letter_fl = $new_name;
                   $amount1 = $post['install_amount_one'];
                   $date1 = $post['install_date_one'];

                   $insert_derogation = $con->prepare("INSERT INTO delogation(delogation_student,delogation_file,delogation_intst1_amount,delogation_intst1_date,delogation_intst2_amount,delogation_intst2_date) VALUES(?,?,?,?,?,?)");
                   $insert_derogation->bindValue(1,$st_id);
                   $insert_derogation->bindValue(2,$letter_fl);
                   $insert_derogation->bindValue(3,$amount1);
                   $insert_derogation->bindValue(4,$date1);
                   $insert_derogation->bindValue(5,$amount2);
                   $insert_derogation->bindValue(6,$date2);
                   $ok_insert_derogation = $insert_derogation->execute();
                   if ($ok_insert_derogation) {
                       echo "<script>window.location='student.php?done'</script>";
                   }else{
                    print_r($insert_derogation->errorInfo());
                   }

                }else{
                    echo "<script>Operation Failed ...</script>";
                }
                  // echo '<pre>';
                  // var_dump($post);
                  // var_dump($files);
                  // echo '</pre>';
            }
        }
        $MainOperations = new MainOperations();
        if (isset($_POST)) {
            $MainOperations->register_derogation($MainView->student_name($_POST['roll']),$MainView->student_id($_POST['roll']),$_POST,$_FILES);
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>ULK - Students financial derogation</title>

    <!-- Font special for pages-->


    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" media="all">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

</head>

<body>
<?php
$status = $alert = null;
if ($MainView->is_derogation_exist($roll)) {
    switch ($MainView->derogation_status($roll)) {
        case 'Approved':
            ?>
                <div style="color: black" class="page-wrapper bg-dark p-t-100 p-b-50">
                    <div class="wrapper wrapper--w900 alert alert alert-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-success" role="alert" style="font-weight: bolder;font-size: 20px">
                                                    <center style="color: black"><?=$MainView->my_approved_derogation($roll);?></center><a href="." style="float: right;text-decoration: underline;"> Back </a>&nbsp;&nbsp;

                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            <?php
            break;
        case 'Rejected':
            ?>
                <div style="color: black" class="page-wrapper bg-dark p-t-100 p-b-50">
                    <div class="wrapper wrapper--w900 alert alert-danger">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger" role="alert" style="font-weight: bolder;font-size: 20px">
                                                    <center style="color: black"><?=$MainView->my_rejected_derogation($roll);?></center><a href="." style="float: right;text-decoration: underline;"> Back </a>&nbsp;&nbsp;

                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            <?php
            break;
        
        default:
            ?>
                <div style="color: black" class="page-wrapper bg-dark p-t-100 p-b-50">
                    <div class="wrapper wrapper--w900 alert alert-secondary">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-secondary" role="alert" style="font-weight: bolder;font-size: 20px">
                                                    <center style="color: black"><?=$MainView->my_notyet_derogation($roll);?></center><a href="." style="float: right;text-decoration: underline;"> Back </a>&nbsp;&nbsp;

                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            <?php
            break;
    }
?>

<?php
}else{
if (($MainView->student_name($_POST['roll'])=="null")) {
?>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900 alert alert-danger">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert" style="font-weight: bolder;font-size: 20px">
                                        <center><h2><p>Rollnumber not exists<a href="student" style="float: right;font-size: 23px;text-decoration: underline;">Exit</a></p></h2></center>

                                    </div>
                                </div>
                            </div>
        </div>
    </div>
<?php
}else{
?>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title" style="color: #000"><center>ULK - Student financial derogation form</center></h2>
                    
                    <center><h3><a href="." style="float: right;text-decoration: underline;"> Back </a>&nbsp;&nbsp;<?=$MainView->student_name($_POST['roll'])?></h3></center>
                </div>
                <div class="card-body">
                    <form id="derogation.php" method="post" action="" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="row">
                                <div class="col-3">
                                    <div class="alert alert-danger" role="alert" style="font-weight: bolder">Note:</div>
                                </div>
                                <div class="col-9">
                                    <div class="alert alert-info" role="alert" style="font-weight: bolder"><p>By submitting this form you're requesting your financial case to be derogated in finance department. You're obliged to give correct information in order too be derogated</p>
                                <div class="alert alert-success" role="alert">
                                  <li>Write a formal letter to the ULK-DAF indicating your current payment status, proposed payment installments you wish</li>
                                  <li>Indicate precised payment amount and dates of payment installments</li>
                                  <li>Maximum installments phases are two installments.</li>
                                  <li>Submit your derogation form to be approved or rejected.</li>
                                  <li>Check your derogation response via this link.</li>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert" role="alert" id="alert" style="text-align: center;max-height: 20px">&nbsp;&nbsp;</div>
                        <div class="form-row">
                            <div class="name">Upload Letter</div>
                            <div class="value">
                                <input class="form-control" type="file" id="file" name="file" required />
                                <div class="label--desc">Upload your <b>Signed-PDF</b> letter. Max file size <b>50 MB</b></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name" style="text-decoration: underline;text-decoration-style: double;">First installment</div>
                            <div class="value">
                                <div class="input-group">
                                    <label style="font-weight: bolder;"> Amount&nbsp;</label>:&nbsp;<input type="number" class="form-control" placeholder="Amount" name="install_amount_one" id="install_amount_one" required="true">
                                    <label style="font-weight: bolder;"> Date:&nbsp;</label>
                                    <input type="date" class="form-control" placeholder="date" id="install_date_one" name="install_date_one" required="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name"><span style="text-decoration: underline;text-decoration-style: double;">Second installment</span> <span style="font-weight: lighter;font-style: italic;color: #f87">(If exists)</span></div>

                            <div class="value">
                                <div class="input-group">
                                    <label style="font-weight: bolder;"> Amount&nbsp;</label>:&nbsp;<input type="number" class="form-control" placeholder="Amount" name="install_amount_two" id="install_amount_two">
                                    <label style="font-weight: bolder;"> Date:&nbsp;</label>
                                    <input type="date" class="form-control" placeholder="date" id="install_date_two" name="install_date_two">
                                    <input type="hidden" name="roll" value="<?=$roll?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
}
    ?>
    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script src="js/web.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->