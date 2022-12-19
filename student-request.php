<?php
if (!isset($_POST['roll'])) {
    echo "<script>window.location='student.php'</script>";
}
$roll = $_POST['roll'];
require("js/view.php");
$MainView = new MainView();
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
  $roll = $_POST['roll'];
?>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">

                    <h2 class="title" style="color: #000"><center>
                      <a href="staff/student-documents?roll=<?=$roll?>" style="float: left;text-decoration: underline;font-size: 25px"> My Documents</a>
                      <a href="." style="float: right;text-decoration: underline;font-size: 25px"> Back </a>&nbsp;&nbsp;
                      <br>ULK - Student-Documents</center></h2>
                    
                    <center><h3>&nbsp;&nbsp;<?=$MainView->student_name($_POST['roll'])?></h3></center>
                </div>
                <div class="card-body">
                    <formmmm>
<!--                         <div class="form-row">
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
                        </div> -->
                        <!-- <div class="alert" role="alert" id="alert" style="text-align: center;max-height: 20px">&nbsp;&nbsp;</div> -->
                        <div class="form-row">
                            <div class="name">Document type</div>
                            <div class="value">
                                <select name="documents" id="documents" class="form-control" style="width: 50%;float: right;" onchange="return switchForms();">
                                    <option value="1">Data Collection Recommendation</option>
                                    <option value="2">English As Medium Of Instruction</option>
                                    <option value="3">Internership Recommendation</option>
                                    <option value="4">Migration Recommendation For a New Commer</option>
                                    <option value="5">Migration Recommendation For a Continuing Student</option>
                                    <option value="6">Professional Internalship</option>
                                    <option value="7">Suspension Letter</option>
                                    <option value="8">Further Studies Recommendation Letter</option>
                                    <option value="9">Attendance Testimonial</option>
                                </select><br>
                                <div class="label--desc">Choose only <b>One document</b></div>
                            </div>
                        </div>

  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="inputEmail4">Student Names</label>
      <input name="su_std_request_name" type="text" class="form-control" id="su_std_request_name" placeholder="Student Names" style="width: 100%">
    </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">Rollnumber</label>
      <input name="insu_std_request_roll" type="text" class="form-control" id="insu_std_request_roll" placeholder="Rollnumber" style="width: 100%">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Class</label>
      <select name="su_std_request_class" class="form-control" id="su_std_request_class">
        <option selected="true" value="">Class</option>
          <?=$MainView->availble_academic_classes();?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">Academic Year</label>
      <select name="insu_std_request_year" class="form-control" id="insu_std_request_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputZip">Faculty</label>
      <select name="sel_fac_std" class="form-control" onchange="return selDeptFatStudent();" id="sel_fac_std">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Department</label>
      <select name="sel_dept_std" class="form-control" disabled="true" id="sel_dept_std">
          <option>Select department</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputZip">Section</label>
      <select name="std_section" class="form-control" id="std_section">
          <option>Day</option>
          <option>Evening</option>
          <option>Weekend</option>
      </select>
    </div>
    <div class="form-group col-md-12">
      <label for="inputZip"><b>Reason for the request</b></label>
      <textarea class="form-control" id="sub_reason"></textarea>
    </div>
  </div> 
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Phone</label>
      <input type="text" id="sub_phone" class="form-control" placeholder="Enter your phone">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Email</label>
      <input type="email" class="form-control" id="sub_email" placeholder="Enter your email">
    </div>
  </div> 
    <div class="form-row">
      <button class="btn btn-primary" type="submit" onclick="return subStudentReq();">Submit</button>
      <div class="alert" role="alert" id="alert" style="text-align: center;max-height: 20px">&nbsp;&nbsp;</div>
  </div>
                    </formmmm>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
    ?>
    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script src="js/web.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->